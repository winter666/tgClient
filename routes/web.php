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
});

Route::prefix('home')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});
