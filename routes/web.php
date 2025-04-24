<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    OrderController,
    ProductController,
    ProductCategoryController,
    UserController,
    CashierController
};

Route::get('/', fn() => view('auth.login'));

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])
            ->middleware('canDeleteUser')
            ->name('users.destroy');

        Route::resource('products', ProductController::class)->except(['index']);
        Route::resource('product-categories', ProductCategoryController::class);

        Route::get('/products', function () {
            return view('products.index');
        })->middleware(['auth', 'role:superadmin'])->name('admin.index');
        

        Route::get('/dashboard', fn() => view('dashboard'))
            ->middleware(['auth', 'verified'])
            ->name('dashboard');
    });

    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::middleware('role:kasir')->group(function () {
        Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::post('/cashier', [CashierController::class, 'store'])->name('cashier.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('orders', OrderController::class);
});

require __DIR__ . '/auth.php';
