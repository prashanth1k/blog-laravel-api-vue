<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/api/register', [RegisteredUserController::class, 'store'])
  ->name('register');
// ->middleware('guest')

Route::post('/api/login', [AuthenticatedSessionController::class, 'store'])
  ->name('login');
// ->middleware('guest')

Route::post('/api/forgot-password', [PasswordResetLinkController::class, 'store'])
  ->middleware('guest')
  ->name('password.email');

Route::post('/api/reset-password', [NewPasswordController::class, 'store'])
  ->middleware('guest')
  ->name('password.store');

Route::get('/api/verify-email/{id}/{hash}', VerifyEmailController::class)
  ->middleware(['auth', 'signed', 'throttle:6,1'])
  ->name('verification.verify');

Route::post('/api/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
  ->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');

Route::post('/api/logout', [AuthenticatedSessionController::class, 'destroy'])
  ->middleware(['auth:sanctum'])
  ->name('logout');
// ->middleware('auth')
