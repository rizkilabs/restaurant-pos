<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100 text-gray-800">

    <h1 class="text-2xl font-bold mb-4">Product Categories</h1>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded p-3">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('product-categories.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Add Category</a>

    <table class="min-w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">#</th>
                <th class="py-2 px-4 border-b text-left">Name</th>
                <th class="py-2 px-4 border-b text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('product-categories.edit', $category) }}"
                            class="text-indigo-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('product-categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this category?')"
                                class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>