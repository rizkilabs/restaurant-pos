@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p>Role Anda: <span class="font-semibold">{{ auth()->user()->role }}</span></p>
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- <a href="{{ route('users.index') }}" class="p-4 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded shadow">
            Kelola Pengguna
        </a> -->
        <a href="#"></a>
        <a href="{{ route('cashier.create') }}" class="p-4 bg-green-100 hover:bg-green-200 text-green-800 rounded shadow">
            Transaksi
        </a>
        <a href="{{ route('products.index') }}" class="p-4 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded shadow">
            Stok Produk
        </a>
        <a href="#"></a>
        <!-- <a href="{{ route('orders.index') }}" class="p-4 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded shadow">
            Daftar Pesanan
        </a> -->
    </div>
        <p class="mt-4">Silakan gunakan menu di atas untuk melakukan transaksi atau melihat stok produk.</p>
    </div>
@endsection
