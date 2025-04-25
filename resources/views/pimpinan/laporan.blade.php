@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
    <h1 class="text-xl font-bold mb-4">Laporan Penjualan</h1>

    <ul class="list-disc list-inside mb-4">
        <li><a href="#" class="text-blue-600 hover:underline">Harian</a></li>
        <li><a href="#" class="text-blue-600 hover:underline">Mingguan</a></li>
        <li><a href="#" class="text-blue-600 hover:underline">Bulanan</a></li>
    </ul>

    {{-- Nanti bisa diisi chart atau table --}}
    <div class="bg-white shadow rounded p-4">
        <p>Belum ada data laporan ditampilkan. Silakan integrasikan dengan laporan penjualan.</p>
    </div>
@endsection
