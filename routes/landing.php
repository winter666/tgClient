<?php

Route::namespace('App\Http\Controllers\Landing')->group(function () {
    Route::get('/', 'LandingController@index')->name('landing.index');
    Route::get('/prizes', 'LandingController@prizesPage')->name('landing.prizes');
});
