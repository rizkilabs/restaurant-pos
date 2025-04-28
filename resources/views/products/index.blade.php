@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <div id="success-message" data-message="{{ session('success') }}"></div>

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add Product</a>
    </div>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">#</th>
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Price</th>
                <th class="p-2 text-left">Photo</th>
                <th class="p-2 text-left">Category</th>
                <th class="p-2 text-left">Stock</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td class="p-2">{{ $index + 1 }}</td>
                <td class="p-2">{{ $product->product_name }}</td>
                <td class="p-2">Rp{{ number_format($product->product_price, 0, ',', '.') }}</td>
                <td class="p-2">
                    @if($product->product_photo)
                    <img src="{{ asset('storage/' . $product->product_photo) }}" class="w-16 h-16 object-cover rounded" alt="photo">
                    @endif
                </td>
                <td class="p-2">{{ $product->category->name ?? '-' }}</td>
                <td class="p-2">{{ $product->stock ?? '-' }}</td>
                <td class="p-2">
                    <span class="px-2 py-1 text-xs font-semibold rounded {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="p-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin hapus?')">Delete</button>
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
            text: message
        });
    }
</script>
@endsection
