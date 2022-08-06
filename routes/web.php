<?php
/**
 * Web routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\TicketsController;

Route::prefix('{lang?}')->middleware('locale')->group(function(){
    
    Route::group(['prefix' => env('APP_VERSION', "v1")], function(){

        /**
         * Home page route.
         */
        Route::get('', function () {return view('pages.home');})->name('home');

        /**
         * Auth routes.
         */
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
        });

        /**
         * Ticket routes.
         */
        Route::prefix('ticket')->group(function(){
            Route::get('/ask-question', [TicketsController::class, 'askQuestion'])->name('ask-question');
            Route::post('/ask-question', [TicketsController::class, 'askQuestionPost'])->name('ask-question-post');
            Route::get('/ticket-created/{ticket_id}', [TicketsController::class, 'ticketCreated'])->name('ticket-created');
            //TODO
            Route::get('/update/{ticket_id}', [TicketsController::class, 'update'])
                ->middleware('authenticated')
                ->name('update-ticket');
            Route::post('/update/{ticket_id}', [TicketsController::class, 'updatePost'])
                ->middleware('authenticated')
                ->name('update-ticket-post');
            Route::get('/list', [TicketsController::class, 'list'])
                ->middleware('authenticated')
                ->name('tickets-list');

            //TODO
            Route::post('/delete/{ticket_id}', [TicketsController::class, 'delete'])
                ->middleware('authenticated')
                ->name('delete-ticket');
        });

    });
});
