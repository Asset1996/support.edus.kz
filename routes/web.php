<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('{lang?}')->middleware('locale')->group(function(){
    
    Route::group(['prefix' => env('APP_VERSION', "v1")], function(){

        Route::get('', function () {
            return view('pages.home');
        })->name('home');

        Route::post('/registration', [AuthController::class, 'registration'])->name('registration-post');
        Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify-email');

        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
        Route::get('/set-new-password/{token}', [AuthController::class, 'setNewPassword'])->name('set-new-password');
        Route::post('/set-new-password/{token}', [AuthController::class, 'setNewPasswordPost'])->name('set-new-password-post');
    });
});
