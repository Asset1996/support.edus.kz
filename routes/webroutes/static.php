<?php
/**
 * Tickets routes.
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/reference-book', function(){
    $references = Cache::remember('references', 172800, function () {
        return \App\Models\StaticModels\ReferenceBook::get();
    });
    return view('pages.static.referenceBook', [
        'references' => $references
    ]);
})->name('reference-book');

Route::get('/about-platform', function(){
    return view('pages.static.aboutPlatform');
})->name('about-platform');

Route::get('/cooperation-proposal', function(){
    return view('pages.static.cooperationProposal');
})->name('cooperation-proposal');

Route::get('/legal-details', function(){
    return view('pages.static.legalDetails');
})->name('legal-details');

Route::get('/terms-of-use', function(){
    return view('pages.static.termsOfUse');
})->name('terms-of-use');

Route::get('/help', function(){
    return view('pages.static.help');
})->name('help');

Route::get('/support', function(){
    return view('pages.static.support');
})->name('support');

Route::get('/privacy-policy', function(){
    return view('pages.static.privacyPolicy');
})->name('privacy-policy');