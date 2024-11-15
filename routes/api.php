<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PublishersController;

Route::controller(NetworksController::class)
    ->group(
        function () {
            Route::get('1/networks', 'index');
            Route::post('1/networks', 'store');
            Route::get('1/networks/{network}', 'show');
            Route::put('1/networks/{network}', 'update');
            // destroy() not implemented - use PUT route
        }
    );

Route::controller(PublishersController::class)
    ->group(
        function () {
            Route::get('1/publishers', 'index');
            Route::post('1/publishers', 'store');
            Route::get('1/publishers/{publisher}', 'show');
            Route::put('1/publishers/{publisher}', 'update');
            Route::delete('1/publishers/{publisher}', 'destroy');
        }
    );

Route::post('1/register-user', [RegisteredUserController::class, 'store'])
    ->middleware([App\Http\Middleware\GlobalAccessTokenMiddleware::class])
    ->name('register');

Route::post('1/login', [AuthenticatedSessionController::class, 'store'])
    // ->middleware('guest') // TODO review
    ->name('login');

Route::post('1/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('1/user', function (Request $request) {
    return $request->user();
});

// TODO review/implement
/*
Route::post('1/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('1/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('1/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('1/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
*/