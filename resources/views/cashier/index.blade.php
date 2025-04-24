@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-semibold mb-6">Transaksi Kasir</h1>

        <!-- Select Produk -->
        <div class="bg-white p-4 rounded-2xl shadow mb-6">
            <label class="block text-sm font-medium mb-2">Pilih Produk</label>
            <div class="flex gap-4 items-center">
                <select id="productSelect" class="w-full p-2 border border-gray-300 rounded-xl">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-name="{{ $product->product_name }}"
                            data-price="{{ $product->product_price }}">
                            {{ $product->product_name }} - Rp{{ number_format($product->product_price) }}
                        </option>
                    @endforeach
                </select>
                <button onclick="addProduct()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">Tambah</button>
            </div>
        </div>

        <!-- Keranjang -->
        <div class="bg-white p-4 rounded-2xl shadow mb-6">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 uppercase border-b">
                    <tr>
                        <th class="py-2">Produk</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2">Qty</th>
                        <th class="py-2">Subtotal</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="cartBody" class="text-gray-800"></tbody>
            </table>

            <div class="text-right mt-4 text-lg font-semibold">
                Total: <span class="text-green-600">Rp<span id="grandTotal">0</span></span>
            </div>
        </div>

        <!-- Simpan -->
        <form id="checkoutForm" method="POST" action="{{ route('cashier.store') }}" class="bg-white p-4 rounded-2xl shadow">
            @csrf
            <input type="hidden" name="order_detail" id="orderDetail">
            <input type="hidden" name="order_amount" id="orderAmount">
            <button type="submit"
                class="w-full px-6 py-3 bg-green-600 text-white rounded-xl text-lg hover:bg-green-700 transition">
                Simpan Transaksi
            </button>
        </form>
    </div>

    <script>
        const cart = [];

        function addProduct() {
            const select = document.getElementById('productSelect');
            const selected = select.options[select.selectedIndex];
            const id = selected.value;
            const name = selected.getAttribute('data-name');
            const price = parseFloat(selected.getAttribute('data-price'));

            if (!id) return;

            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.qty += 1;
                existing.subtotal = existing.qty * price;
            } else {
                cart.push({ id, name, price, qty: 1, subtotal: price });
            }

            renderCart();
        }

        function renderCart() {
            const tbody = document.getElementById('cartBody');
            const totalEl = document.getElementById('grandTotal');
            tbody.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                total += item.subtotal;
                tbody.innerHTML += `
                        <tr class="border-b">
                            <td class="py-2">${item.name}</td>
                            <td class="py-2">Rp${item.price.toLocaleString()}</td>
                            <td class="py-2">
                                <input type="number" min="1" value="${item.qty}" 
                                    onchange="updateQty(${index}, this.value)" 
                                    class="w-16 px-2 py-1 border border-gray-300 rounded text-center" />
                            </td>
                            <td class="py-2">Rp${item.subtotal.toLocaleString()}</td>
                            <td class="py-2">
                                <button onclick="removeItem(${index})" class="text-red-500 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    `;
            });

            totalEl.textContent = total.toLocaleString();
            document.getElementById('orderDetail').value = JSON.stringify(cart);
            document.getElementById('orderAmount').value = total;
        }

        function updateQty(index, qty) {
            qty = parseInt(qty);
            if (qty < 1) return;
            cart[index].qty = qty;
            cart[index].subtotal = qty * cart[index].price;
            renderCart();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            renderCart();
        }
    </script>
@endsection