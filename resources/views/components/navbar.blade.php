@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <x-navbar />

    <div class="max-w-7xl mx-auto py-8 px-6">
        <h1 class="text-3xl font-bold mb-4">
            Selamat datang, {{ auth()->user()->name }}!
        </h1>
        <p class="text-lg text-gray-600 mb-8">
            Kamu login sebagai <strong>{{ auth()->user()->role }}</strong>.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('users.index') }}" class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold">Users</h2>
                <p class="text-sm text-gray-500">Kelola pengguna sistem</p>
            </a>
            <a href="{{ route('products.index') }}" class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold">Products</h2>
                <p class="text-sm text-gray-500">Manajemen produk dan stok</p>
            </a>
            <a href="{{ route('product-categories.index') }}" class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold">Product Categories</h2>
                <p class="text-sm text-gray-500">Kategori produk</p>
            </a>
            <a href="{{ route('orders.index') }}" class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition">
                <h2 class="text-xl font-semibold">Orders</h2>
                <p class="text-sm text-gray-500">Daftar pesanan</p>
            </a>
        </div>
    </div>
@endsection
