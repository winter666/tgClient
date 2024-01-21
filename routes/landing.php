<?php

use App\Http\Controllers\Landing\LandingController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Landing')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing.index');
    Route::get('/prizes', [LandingController::class, 'prizesPage'])->name('landing.prizes');
});
