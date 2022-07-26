<?php
use Illuminate\Support\Facades\Route;

Route::prefix('{lang?}')->middleware('locale')->group(function(){
    
    Route::group(['prefix' => env('APP_VERSION', "v1")], function(){

        Route::get('', function () {
            return view('welcome');
        });
    });
});
