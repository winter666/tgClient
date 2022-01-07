<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('App\Http\Controllers\Api')->middleware('auth:sanctum')->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('auth', 'UserController@getCurrent');
//        Route::middleware('admin')->group(function() {
//            Route::get('{id}', 'AdminController@getUser');
//        });
    });

    Route::prefix('bot')->group(function() {
//        Route::middleware('admin')->group(function() {
//            Route::get('all', 'AdminController@getAllBots');
//        });
        Route::prefix('get')->group(function() {
            Route::get('', 'BotController@get');
            Route::get('{bot_id}', 'BotController@getById');
        });
        Route::post('create', 'BotController@create');
        Route::patch('update', 'BotController@update');
        Route::delete('delete', 'BotController@update');
    });

});
