<?php
/**
 * Auth routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('auth')->group(function(){
    /**
     * Auth routes.
     */
    Route::post('/registration', [AuthController::class, 'registration'])
        ->middleware('guest')
        ->name('registration-post');
    Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])
        ->middleware('guest')
        ->name('verify-email');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->middleware('guest')
        ->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('authenticated')
        ->name('logout');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->middleware('guest')
        ->name('reset-password');
    Route::get('/set-new-password/{token}', [AuthController::class, 'setNewPassword'])
        ->middleware('guest')
        ->name('set-new-password');
    Route::post('/set-new-password/{token}', [AuthController::class, 'setNewPasswordPost'])
        ->middleware('guest')
        ->name('set-new-password-post');
    Route::get('/change-password', [AuthController::class, 'changePassword'])
        ->middleware('authenticated')
        ->name('change-password');
    Route::post('/change-password-post', [AuthController::class, 'changePasswordPost'])
        ->middleware('authenticated')
        ->name('change-password-post');
});

