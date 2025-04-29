@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mt-6">
        <div id="success-message" data-message="{{ session('success') }}"></div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Order List</h2>
            <a href="{{ route('orders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ New Order</a>
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Code</th>
                    <th class="px-4 py-2 text-left">Amount</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Change</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $order->order_code }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($order->order_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($order->order_status) }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($order->order_change, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('orders.edit', $order) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button" class="text-red-500 hover:underline delete-button"
                                    data-code="{{ $order->order_code }}">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const message = document.getElementById('success-message').dataset.message;
        if (message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const code = this.dataset.code;

                Swal.fire({
                    title: `Hapus order ${code}?`,
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection