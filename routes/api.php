<?php

use App\Http\Controllers\Api\BotController;
use App\Http\Controllers\Api\UserController;
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

    // USER

    Route::prefix('user')->group(function() {
        Route::get('auth', [UserController::class, 'authorized']);
        Route::prefix('{user}')->group(function() {
            Route::patch('update', [UserController::class, 'update']);
        });
    });

    // BOT

    Route::prefix('bot')->group(function() {
        Route::get('list', [BotController::class, 'index']);
        Route::post('store', [BotController::class, 'store']);
        Route::get('{bot}', [BotController::class, 'show']);
        Route::patch('{bot}', [BotController::class, 'update']);
        Route::delete('{bot}', [BotController::class, 'destroy']);
    });
});
