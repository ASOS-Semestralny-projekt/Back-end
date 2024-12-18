<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkUserLoggedIn'])->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);
    Route::put('/user/password', [UserController::class, 'updatePassword']);
    Route::get('/orders', [OrderController::class, 'getOrders']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products/{categoryId}', [ProductController::class, 'getByCategory']);
Route::get('/product/{productId}', [ProductController::class, 'getById']);
Route::post('/place-order', [OrderController::class, 'placeOrder']);

