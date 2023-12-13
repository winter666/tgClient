<?php

use Illuminate\Support\Facades\Route;

Route::prefix('home')->middleware('auth')->group(function() {
    Route::get('*', function () {
        return view('home.index');
    })->name('home')->where('any', '.*');
});
