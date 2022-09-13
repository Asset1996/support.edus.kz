<?php
/**
 * Profile routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;

Route::prefix('profile')->middleware('authenticated')->group(function(){
    Route::get('', [ProfileController::class, 'getProfile'])->name('profile');
    Route::post('/update', [ProfileController::class, 'updateProfile'])->name('profile-update');
});

