<?php

Route::prefix('home')->middleware('auth')->group(function() {
    // Vue path
    Route::get('/', function () {
        return view('home.index');
    })->name('home');

    // Vue path uri-levels
    Route::prefix('{vue_uri_first_level}')->group(function() {
        Route::get('', function() { return view('home.index'); })->name('home.vue_uri.level.first');

        Route::prefix('{vue_uri_second_level}')->group(function() {
            Route::get('', function() { return view('home.index'); })->name('home.vue_uri.level.second');

            Route::prefix('{vue_uri_third_level}')->group(function() {
                Route::get('', function() { return view('home.index'); })->name('home.vue_uri.level.third');
                // another levels...
            });
        });
    });
});
