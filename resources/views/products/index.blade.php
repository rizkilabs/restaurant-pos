<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <a href="{{ route('products.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Product</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">#</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Price</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Photo</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Category</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $index => $product)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $product->product_name }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($product->product_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">
                            @if($product->product_photo)
                                <img src="{{ asset('storage/' . $product->product_photo) }}" alt="photo"
                                    class="w-16 h-16 rounded object-cover">
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('products.edit', $product) }}"
                                class="text-indigo-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>