<?php

use Illuminate\Support\Facades\Route;

/**
 * Single Page Application (SPA) Route.
 * This route tells Laravel to return the 'welcome' view for ANY URL
 * (like /register, /login, /exercises), allowing Vue Router to handle the navigation.
 */
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

// Include authentication routes provided by Laravel Breeze
require __DIR__.'/auth.php';
