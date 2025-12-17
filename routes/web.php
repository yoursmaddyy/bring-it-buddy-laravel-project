<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TravellerController; // <--- Fixed Import
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\AdminController;

Route::get('/register-form', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-submit', [AuthController::class, 'store'])->name('register.post');

Route::get('/verify-account-enter-email', [AuthController::class, 'showVerify'])->name('auth.verify');
Route::post('/verify-account-enter-email', [AuthController::class, 'sendOtp'])->name('otp.send');

Route::get('/verify-account-enter-otp', [AuthController::class, 'showOtpConfirm'])->name('auth.otp.confirm');
Route::post('/verify-account-check-otp', [AuthController::class, 'verifyOtp'])->name('otp.check');

// ... existing verify routes ...

// DASHBOARD (Protected by Auth middleware)



// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- MAIN APP ROUTES (Protected) ---

Route::middleware('auth')->group(function () {

    // 1. Unified Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.dash');
    })->middleware('auth')->name('dashboard');

    // 2. TRAVELLER ROUTES (Fixed to use TravellerController)
    
    // View all trips (Public Feed for Buyers)
    Route::get('/feed', [TravellerController::class, 'index'])->name('traveller.index');

    // Manage My Trips
    Route::get('/my-trips', [TravellerController::class, 'myPosts'])->name('traveller.my_posts');
    Route::get('/post-trip', [TravellerController::class, 'create'])->name('traveller.create');
    Route::post('/post-trip', [TravellerController::class, 'store'])->name('traveller.store');
    
    // Edit & Delete
    Route::get('/edit-trip/{id}', [TravellerController::class, 'edit'])->name('traveller.edit');
    Route::put('/edit-trip/{id}', [TravellerController::class, 'update'])->name('traveller.update');
    Route::delete('/delete-trip/{id}', [TravellerController::class, 'destroy'])->name('traveller.destroy');


    // 3. BUYER ROUTES
    Route::get('/my-orders', [BuyerController::class, 'index'])->name('buyer.index');

    // Create Request (Needs Trip ID)
    Route::get('/request-item/{post_id}', [BuyerController::class, 'create'])->name('buyer.create');
    Route::post('/request-item/{post_id}', [BuyerController::class, 'store'])->name('buyer.store');

    // Edit & Cancel
    Route::get('/edit-request/{id}', [BuyerController::class, 'edit'])->name('buyer.edit');
    Route::put('/edit-request/{id}', [BuyerController::class, 'update'])->name('buyer.update');
    Route::delete('/cancel-request/{id}', [BuyerController::class, 'destroy'])->name('buyer.destroy');


    // 4. ADMIN ROUTES
    Route::get('/admin-panel', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // View Requests for a specific trip
    Route::get('/trip/{id}/requests', [TravellerController::class, 'viewRequests'])->name('traveller.view_requests');
    
    // Accept/Reject Action
    Route::put('/request/{id}/status', [TravellerController::class, 'updateRequestStatus'])->name('traveller.request.update');

});