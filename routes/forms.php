<?php

Route::prefix('forms')->group(function() {
    Route::get('/login', function () {
        return view('landing.parts.modals.login');
    })->name('forms.login');
    Route::get('/register', function () {
        return view('landing.parts.modals.register');
    })->name('forms.register');
});
