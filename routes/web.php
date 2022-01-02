<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

require 'landing.php'; // landing routes

require 'vue.php'; // in app home vue - levels routes

require 'forms.php'; // modal form templates routes

Route::fallback(function() {
    return view('errors.not-found');
})->name('fallback');
