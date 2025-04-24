@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mt-6">
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
                            <a href="{{ route('orders.edit', $order) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline"
                                    onclick="return confirm('Delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection