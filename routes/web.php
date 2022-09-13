<?php
/**
 * Web routes.
 */
use Illuminate\Support\Facades\Route;

Route::prefix('{lang?}')->middleware('locale')->group(function(){
    
    Route::group(['prefix' => env('APP_VERSION', "v1")], function(){

        /**
         * Home page route.
         */
        Route::get('', [\App\Http\Controllers\HomeController::class, 'getHome'])->name('home');

        /**
         * Auth routes.
         */
        include('webroutes/auth.php');

        /**
         * Tickets routes.
         */
        include('webroutes/tickets.php');

        /**
         * Messages routes.
         */
        include('webroutes/messages.php');

        /**
         * Profile routes.
         */
        include('webroutes/profile.php');

        /**
         * Control panel routes.
         */
        include('webroutes/control.php');

        /**
         * Static routes (about, reference_book etc).
         */
        include('webroutes/static.php');
    });
});

Route::get('', function () {return redirect()->route('home', ['lang' => config('app.locale')]);});
