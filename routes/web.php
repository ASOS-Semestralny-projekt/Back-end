<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products/{categoryId}', [ProductController::class, 'getByCategory']);
Route::get('/product/{productId}', [ProductController::class, 'getById']);
