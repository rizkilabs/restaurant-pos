<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product-categories', \App\Http\Controllers\ProductCategoryController::class);
