@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Laporan Bulanan</h1>

        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Produk</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Subtotal</th>
                    <th class="px-4 py-2">Waktu Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-center">{{ $item->product->product_name }}</td>
                        <td class="px-4 py-2 text-center">{{ $item->qty }}</td>
                        <td class="px-4 py-2 text-center">Rp {{ number_format($item->order_subtotal, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-center">
                            {{ $item->order->created_at->format('d-m-Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
@endsection
