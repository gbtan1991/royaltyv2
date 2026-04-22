<?php

use App\Helpers\Route;
use App\Controllers\admin\AdminController;

/**
 * Admin Routes
 * We use the Route helper (Translator) instead of the $router variable
 */

// This now works because the Helper converts the array to a string!
Route::get('/admin', [AdminController::class, 'index']);

// Example of a POST route using the same logic
Route::post('/admin/destroy/{id}', [AdminController::class, 'destroy']);

// You can still use traditional closures if you want
Route::get('/test', function() {
    echo "Routing system is working!";
});