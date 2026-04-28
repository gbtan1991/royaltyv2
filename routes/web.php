<?php

use App\Helpers\Route;
use App\Controllers\admin\AdminController;

/**
 * Admin Routes
 * We use the Route helper (Translator) instead of the $router variable
 */

// This now works because the Helper converts the array to a string!
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/create', [AdminController::class, 'create']);
Route::post('/admin/store', [AdminController::class, 'store']);
Route::get('/admin/show/(\d+)', [AdminController::class, 'show']);
Route::get('/admin/edit/(\d+)', [AdminController::class, 'edit']);
Route::post('/admin/update/(\d+)', [AdminController::class, 'update']);
Route::post('/admin/destroy/(\d+)', [AdminController::class, 'destroy']);
