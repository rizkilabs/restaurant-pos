<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    OrderController,
    ProductController,
    ProductCategoryController,
    UserController,
    CashierController,
    AdminDashBoardController,
    PimpinanReportController
};

// Halaman login sebagai default
Route::get('/', fn() => view('auth.login'));

// Middleware untuk user yang sudah login dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // ==========================
    // SUPERADMIN
    // ==========================
    Route::middleware('role:superadmin')->group(function () {

        // Dashboard superadmin
        Route::get('/admin', [AdminDashBoardController::class, 'adminDashboard'])->name('admin.dashboard');

        // Manajemen User
        Route::resource('users', UserController::class);

        // Produk & Kategori (penuh)
        Route::resource('products', ProductController::class)->except(['index']);
        Route::resource('product-categories', ProductCategoryController::class);

        // Order
        Route::resource('orders', OrderController::class);
    });

    // ==========================
    // KASIR & SUPERADMIN
    // ==========================
    Route::middleware('role:kasir,superadmin')->group(function () {

        // Dashboard kasir
        Route::get('/cashier', fn() => view('cashier.dashboard'))->name('cashier.dashboard');

        // Transaksi kasir
        Route::get('/cashier/transaction', [CashierController::class, 'create'])->name('cashier.create');
        Route::post('/cashier/transaction', [CashierController::class, 'store'])->name('cashier.store');
    });

    // ==========================
    // PIMPINAN & SUPERADMIN
    // ==========================
    Route::middleware('role:pimpinan,superadmin')->group(function () {

        Route::get('/pimpinan', fn() => view('pimpinan.dashboard'))->name('pimpinan.dashboard');

        // Laporan Penjualan
        Route::get('/pimpinan/reports/harian', [PimpinanReportController::class, 'harian'])->name('pimpinan.reports.harian');
        Route::get('/pimpinan/reports/mingguan', [PimpinanReportController::class, 'mingguan'])->name('pimpinan.reports.mingguan');
        Route::get('/pimpinan/reports/bulanan', [PimpinanReportController::class, 'bulanan'])->name('pimpinan.reports.bulanan');
        Route::get('/pimpinan/reports/filter', [PimpinanReportController::class, 'filter'])->name('pimpinan.reports.filter');
    });

    // ==========================
    // AKSES UMUM SEMUA ROLE
    // ==========================

    // Lihat daftar produk
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    // API
    Route::get('/api/products', [ProductController::class, 'getProducts']);
    Route::post('/api/orders', [OrderController::class, 'store']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
