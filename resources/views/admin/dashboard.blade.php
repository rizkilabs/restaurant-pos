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

    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-4">Top 5 Produk Paling Sering Dibeli</h2>

        @if($topProducts->count())
        <table class="w-full text-left table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Jumlah Terjual</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $index => $item)
                <tr>
                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $item->product->product_name ?? 'Produk tidak ditemukan' }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item->total_sold }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-gray-600">Belum ada data penjualan.</p>
        @endif
    </div>
</div>
@endsection