<?php
/**
 * Messages routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\MessagesController;

Route::prefix('message')->group(function(){
    Route::post('/write-message/{ticket_uid}', [MessagesController::class, 'writeMessage'])
        ->middleware('authenticated')
        ->name('write-message');
    Route::post('/message/evaluate', [MessagesController::class, 'evaluateMessage'])
        ->middleware('authenticated')
        ->name('evaluate-message');
});
