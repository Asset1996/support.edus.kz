<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('{lang?}')->middleware('locale')->group(function(){
    
    Route::group(['prefix' => env('APP_VERSION', "v1")], function(){

        Route::get('', function () {
            return view('pages.home');
        })->name('home');

        Route::get('/registration', function () {
            return view('pages.auth.registration');
        })->name('registration');
        Route::post('/registration-post', [AuthController::class, 'registration'])->name('registration-post');
        Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify-email');
    });
});
