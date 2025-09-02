<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginVerificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guestUser')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot/password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot/password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/reset/password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset/password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    // Login verification controller routes
    Route::get('/login/verification', [LoginVerificationController::class, 'index'])->name('login.verification');
    Route::post('/login/verification/store', [LoginVerificationController::class, 'store'])->name('login.verification.store');
    Route::get('/login/verification/resend', [LoginVerificationController::class, 'resend'])->name('login.verification.resend');
});

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
