<?php

use Illuminate\Support\Facades\Route;

Route::get('home/{any?}', function () {
    return view('home.index');
})->middleware('auth')
    ->where('any', '.*')
    ->name('home');
