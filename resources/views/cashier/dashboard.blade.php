@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p>Role Anda: <span class="font-semibold">{{ auth()->user()->role }}</span></p>
        <p class="mt-4">Silakan gunakan menu di samping untuk melakukan transaksi atau melihat stok produk.</p>
    </div>
@endsection
