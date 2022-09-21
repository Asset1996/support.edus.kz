<?php
/**
 * Tickets routes.
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\TicketsController;

Route::prefix('ticket')->group(function(){
    Route::get('/view/{ticket_uid}', [TicketsController::class, 'viewTicket'])
        ->middleware('authenticated')
        ->name('view-ticket');
    Route::get('/create-ticket', [TicketsController::class, 'createTicket'])->name('create-ticket');
    Route::post('/create-ticket', [TicketsController::class, 'createTicketPost'])->name('create-ticket-post');
    Route::get('/ticket-created/{ticket_uid}', [TicketsController::class, 'ticketCreated'])->name('ticket-created');
    Route::get('/update/{ticket_uid}', [TicketsController::class, 'updateTicket'])
        ->middleware('authenticated')
        ->name('update-ticket');
    Route::post('/update/{ticket_uid}', [TicketsController::class, 'updateTicketPost'])
        ->middleware('authenticated')
        ->name('update-ticket-post');
    Route::get('/list', [TicketsController::class, 'listTickets'])
        ->middleware('authenticated')
        ->name('tickets-list');
    Route::post('/delete/{ticket_uid}', [TicketsController::class, 'deleteTicket'])
        ->middleware('authenticated')
        ->name('delete-ticket');
    Route::post('/close/{ticket_uid}', [TicketsController::class, 'closeTicket'])
        ->middleware('authenticated')
        ->name('close-ticket');
    Route::post('/evaluate', [TicketsController::class, 'evaluateTicket'])
        ->middleware('authenticated')
        ->name('evaluate-ticket');
});
