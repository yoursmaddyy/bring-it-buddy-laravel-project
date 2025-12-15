<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/register-form', [AuthController::class, 'showRegistrationForm']);
Route::post('/register-submit', [AuthController::class, 'store'])->name('register.post');

Route::get('/verify-account-enter-email', [AuthController::class, 'showVerify'])->name('auth.verify');
Route::post('/verify-account-enter-email', [AuthController::class, 'sendOtp'])->name('otp.send');

Route::get('/verify-account-enter-otp', [AuthController::class, 'showOtpConfirm'])->name('auth.otp.confirm');
Route::post('/verify-account-check-otp', [AuthController::class, 'verifyOtp'])->name('otp.check');