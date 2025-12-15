<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Show Register Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 2. Handle Registration
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'cnic' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'in:buyer,traveller', 
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cnic = $request->cnic;
        $user->password = bcrypt($request->password);
        $user->save();

        foreach ($request->roles as $roleName) {
            $role = Role::where('role_name', $roleName)->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }
        }

        return redirect()->route('auth.verify');
    }

    // 3. Step 1 View: Show "Enter Email" Page
    public function showVerify()
    {
        return view('auth.verify'); 
    }

    // 4. Step 1 Action: Validate Email -> Generate OTP -> Send Mail
    public function sendOtp(Request $request)
    {
        // Validate user exists before doing anything
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $otp = rand(999, 9999); 
        $user = User::where('email', $request->email)->first();
        
        // Save OTP to User Table
        $user->otp = $otp;
        $user->save();

        // Send Email
        $mailData = [
            'title' => 'Your Verification OTP',
            'body' => $otp,
        ];
        
        Mail::to($request->email)->send(new SendMail($mailData));
    
        return redirect()->route('auth.otp.confirm')->with('email', $request->email);
    }

    public function showOtpConfirm()
    {
        if (!session('email')) {
             return redirect()->route('auth.verify')->withErrors(['email' => 'Session expired. Enter email again.']);
        }
        return view('auth.otp-enter');
    }

    // 6. Step 2 Action: Check OTP -> Verify -> Login
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->otp != $request->otp) {
            return back()->with('email', $request->email)->withErrors(['otp' => 'Invalid OTP. Try again.']);
        }

        $user->otp = null; 
        $user->email_verified_at = now();
        $user->save();

        return redirect('/dashboard');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process Login
    public function login(Request $request)
    {
        // 1. Validate: 'login' can be email or username
        $request->validate([
            'login' => 'required|string', 
            'password' => 'required|string',
        ]);
    
        // 2. Find the user (Check Email OR Username)
        $user = User::where('email', $request->login)
                    ->orWhere('username', $request->login)
                    ->first();
    
        // 3. If User exists AND Password matches
        if ($user && Hash::check($request->password, $user->password)) {
            
            // 4. Check Verification
            if ($user->email_verified_at == null) {
                return redirect()->route('auth.verify')
                    ->withErrors(['email' => 'Please verify your email first.']);
            }
    
            // 5. Manually Log the user in
            Auth::login($user);
    
            return redirect()->intended('/dashboard');
        }
    
        // 6. Failure
        return back()->with('error', 'Invalid credentials.');
    }

    // Handle Logout
// Handle Logout
        public function logout()
        {
            Auth::logout(); // This clears the logged-in user
            return redirect()->route('login');
        }
}