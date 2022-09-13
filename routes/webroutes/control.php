<?php
/**
 * Control capnel routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Control\LocalizeController;

Route::prefix('control')->group(function(){
    Route::get('', function(){
        return view('pages.control.index');
    })
        ->middleware('superuser')
        ->name('control-index');

    Route::get('/localize', [LocalizeController::class, 'getLangs'])
        ->middleware('superuser')
        ->name('localize');

    Route::post('/localize', [LocalizeController::class, 'getLangsPost'])
        ->middleware('superuser')
        ->name('localize-post');
});