<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;


Route::prefix('auth')->group(function () {
    // Authentication Routes...
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('auth.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('auth.logout');

    // Registration Routes...
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('auth.register');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    // Password Reset Routes...
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('auth.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('auth.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('auth.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('auth.password.update');
});
