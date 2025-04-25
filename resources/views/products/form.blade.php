<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">
    <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div class="mb-4">
            <label class="block mb-1">Product Name</label>
            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name ?? '') }}"
                   class="w-full border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Category</label>
            <select name="category_id" class="w-full border-gray-300 rounded p-2" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id ?? '') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Price (Rp)</label>
            <input type="number" name="product_price" value="{{ old('product_price', $product->product_price ?? '') }}"
                   class="w-full border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Photo</label>
            <input type="file" name="product_photo" class="w-full border-gray-300 rounded p-2">
            @if($isEdit && $product->product_photo)
                <img src="{{ asset('storage/' . $product->product_photo) }}" class="w-24 mt-2 rounded shadow">
            @endif
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="product_description" class="w-full border-gray-300 rounded p-2"
                      rows="4">{{ old('product_description', $product->product_description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? 0) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>


        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" class="mr-2"
                       {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $isEdit ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
