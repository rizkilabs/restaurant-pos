@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Laporan Mingguan</h1>

        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Produk</th>
                    <th class="px-4 py-2">Jumlah Terjual</th>
                    <th class="px-4 py-2">Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->product_name }}</td>
                        <td class="px-4 py-2">{{ $item->total_qty }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item->total_sales, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection