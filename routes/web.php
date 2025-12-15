<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/register-form', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-submit', [AuthController::class, 'store'])->name('register.post');

Route::get('/verify-account-enter-email', [AuthController::class, 'showVerify'])->name('auth.verify');
Route::post('/verify-account-enter-email', [AuthController::class, 'sendOtp'])->name('otp.send');

Route::get('/verify-account-enter-otp', [AuthController::class, 'showOtpConfirm'])->name('auth.otp.confirm');
Route::post('/verify-account-check-otp', [AuthController::class, 'verifyOtp'])->name('otp.check');

// ... existing verify routes ...

// DASHBOARD (Protected by Auth middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout Route
// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');
