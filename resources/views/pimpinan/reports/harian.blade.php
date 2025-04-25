@extends('layouts.app')

@section('title', 'Laporan Harian')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Laporan Penjualan Harian</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Total Penjualan</h2>
            <p class="text-2xl font-bold text-blue-600">Rp 12.500.000</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Jumlah Transaksi</h2>
            <p class="text-2xl font-bold text-green-600">58</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Produk Terlaris</h2>
            <p class="text-lg font-bold text-indigo-600">Parfum X</p>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Rincian Transaksi Hari Ini</h2>
        <table class="w-full table-auto text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Waktu</th>
                    <th class="px-4 py-2">Kasir</th>
                    <th class="px-4 py-2">Produk</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">08:21</td>
                    <td class="px-4 py-2">Dewi</td>
                    <td class="px-4 py-2">Parfum X</td>
                    <td class="px-4 py-2">3</td>
                    <td class="px-4 py-2">Rp 450.000</td>
                </tr>
                <!-- Tambah data dummy atau real -->
            </tbody>
        </table>
    </div>
@endsection
