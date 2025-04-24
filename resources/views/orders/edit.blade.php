@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 mt-6 shadow rounded">
        <h2 class="text-xl font-semibold mb-4">{{ isset($order) ? 'Edit' : 'Create' }} Order</h2>

        <form action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}" method="POST">
            @csrf
            @if(isset($order)) @method('PUT') @endif

            <div class="mb-4">
                <label class="block mb-1">Order Code</label>
                <input type="text" name="order_code" class="w-full border rounded p-2"
                    value="{{ old('order_code', $order->order_code ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Detail</label>
                <textarea name="order_detail" class="w-full border rounded p-2"
                    rows="3">{{ old('order_detail', $order->order_detail ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Amount</label>
                <input type="number" name="order_amount" class="w-full border rounded p-2"
                    value="{{ old('order_amount', $order->order_amount ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="order_status" class="w-full border rounded p-2">
                    @foreach(['pending', 'paid', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(old('order_status', $order->order_status ?? 'pending') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Change</label>
                <input type="number" name="order_change" class="w-full border rounded p-2"
                    value="{{ old('order_change', $order->order_change ?? '') }}">
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                {{ isset($order) ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
@endsection