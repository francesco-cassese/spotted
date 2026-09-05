<?php

use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('businesses', [BusinessController::class, 'index']);

Route::get('businesses/{slug}', [BusinessController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);
