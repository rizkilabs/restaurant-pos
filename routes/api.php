<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    OrderController,
    ProductController,
};

Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::post('/api/orders', [OrderController::class, 'store']);

