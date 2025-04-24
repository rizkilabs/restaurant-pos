<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product-categories', \App\Http\Controllers\ProductCategoryController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);

