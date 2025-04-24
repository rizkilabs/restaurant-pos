<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100 text-gray-800">

    <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

    <form action="{{ $action }}" method="POST" class="max-w-md bg-white p-6 rounded shadow">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block mb-1 font-medium">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $productCategory->name ?? '') }}"
                class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-indigo-300" required>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $isEdit ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('product-categories.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>

</body>

</html>