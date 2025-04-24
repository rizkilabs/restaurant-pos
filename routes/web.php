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

// Default route (login)
Route::get('/', fn() => view('auth.login'));

// Authenticated & Verified Users
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Role: SUPERADMIN
    Route::middleware('role:superadmin')->group(function () {
        // Dashboard superadmin
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Users
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])
            ->middleware('canDeleteUser')
            ->name('users.destroy');

        // Products (full access kecuali index)
        Route::resource('products', ProductController::class)->except(['index']);

        // Categories
        Route::resource('product-categories', ProductCategoryController::class);
    });

    // Produk index (kasir & superadmin)
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    // Role: KASIR
    Route::middleware('role:kasir')->group(function () {
        Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
        Route::post('/cashier', [CashierController::class, 'store'])->name('cashier.store');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders
    Route::resource('orders', OrderController::class);
});

require __DIR__ . '/auth.php';
