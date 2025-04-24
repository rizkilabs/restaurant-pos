{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600">Role: <strong>{{ Auth::user()->role }}</strong></p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('users.index') }}" class="p-4 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded shadow">
                Kelola Pengguna
            </a>
            <a href="{{ route('products.index') }}" class="p-4 bg-green-100 hover:bg-green-200 text-green-800 rounded shadow">
                Data Produk
            </a>
            <a href="{{ route('product-categories.index') }}" class="p-4 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded shadow">
                Kategori Produk
            </a>
            <a href="{{ route('orders.index') }}" class="p-4 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded shadow">
                Daftar Pesanan
            </a>
        </div>
    </div>
@endsection
