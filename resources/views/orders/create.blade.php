@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Tambah Order</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="order_code" class="block font-semibold">Kode Order</label>
                <input type="text" name="order_code" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="order_status" class="block font-semibold">Status</label>
                <select name="order_status" class="w-full border rounded px-3 py-2" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Produk</label>
                <div id="product-list">
                    <div class="flex gap-2 mb-2">
                        <select name="products[0][product_id]" class="w-1/2 border rounded px-2 py-1">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }} -
                                    Rp{{ number_format($product->product_price) }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="products[0][qty]" class="w-1/4 border rounded px-2 py-1"
                            placeholder="Qty" min="1" value="1">
                    </div>
                </div>

                <button type="button" onclick="addProductRow()" class="text-sm text-blue-600">+ Tambah Produk</button>
            </div>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Simpan Order</button>
        </form>
    </div>

    <script>
        let rowCount = 1;
        function addProductRow() {
            const list = document.getElementById('product-list');
            const newRow = document.createElement('div');
            newRow.classList.add('flex', 'gap-2', 'mb-2');

            newRow.innerHTML = `
                <select name="products[${rowCount}][product_id]" class="w-1/2 border rounded px-2 py-1">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }} - Rp{{ number_format($product->product_price) }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[${rowCount}][qty]" class="w-1/4 border rounded px-2 py-1" placeholder="Qty" min="1" value="1">
            `;
            list.appendChild(newRow);
            rowCount++;
        }
    </script>
@endsection