@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-xl font-bold mb-4">Laporan Berdasarkan Rentang Tanggal</h1>

        <form method="GET" action="{{ route('pimpinan.reports.filter') }}" class="mb-6 flex gap-4 items-end">
            <div>
                <label for="start_date" class="block mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="border px-3 py-2 rounded"
                    value="{{ request('start_date') }}">
            </div>

            <div>
                <label for="end_date" class="block mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="border px-3 py-2 rounded"
                    value="{{ request('end_date') }}">
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Tampilkan</button>
            </div>
        </form>

        @if ($data)
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
                {{ $data->appends(request()->only('start_date', 'end_date'))->links() }}
            </div>
        @elseif(request()->has('start_date') && request()->has('end_date'))
            <p class="text-red-600">Tidak ditemukan data pada rentang tersebut.</p>
        @endif
    </div>
@endsection
