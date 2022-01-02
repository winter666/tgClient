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

Route::namespace('App\Http\Controllers\Landing')->group(function () {
    Route::get('/', 'LandingController@index')->name('landing.index');
    Route::get('/prizes', 'LandingController@prizesPage')->name('landing.prizes');
});

Route::prefix('home')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::prefix('forms')->group(function() {
   Route::get('/login', function () {
       return view('landing.parts.modals.login');
   })->name('forms.login');
   Route::get('/register', function () {
       return view('landing.parts.modals.register');
   })->name('forms.register');
});
