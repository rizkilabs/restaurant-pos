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

// Halaman login sebagai default
Route::get('/', fn() => view('auth.login'));

// Middleware untuk user yang sudah login dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:pimpinan')->group(function () {
        Route::get('/pimpinan', fn() => view('pimpinan.dashboard'))->name('pimpinan.dashboard');

        Route::get('products', [ProductController::class, 'index'])->name('products.index');

        Route::get('/laporan/penjualan', function () {
            return view('pimpinan.laporan');
        })->name('laporan.penjualan');
    });

    // ==========================
    // SUPERADMIN
    // ==========================
    Route::middleware('role:superadmin')->group(function () {

        // Dashboard superadmin
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Manajemen User
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::delete('users/{user}', [UserController::class, 'destroy'])
            ->middleware('canDeleteUser')
            ->name('users.destroy');

        // Produk & Kategori (penuh)
        Route::resource('products', ProductController::class)->except(['index']);
        Route::resource('product-categories', ProductCategoryController::class);

        // Order
        Route::resource('orders', OrderController::class);
    });

    // ==========================
    // KASIR
    // ==========================
    Route::middleware('role:kasir')->group(function () {

        // Dashboard kasir
        Route::get('/cashier', function () {
            return view('cashier.dashboard');
        })->name('cashier.dashboard');

        // Transaksi
        Route::get('/cashier/transaction', [CashierController::class, 'index'])->name('cashier.index');
        Route::post('/cashier/transaction', [CashierController::class, 'store'])->name('cashier.store');
    });

    // ==========================
    // AKSES UMUM (kasir & admin)
    // ==========================

    // Lihat daftar produk
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
