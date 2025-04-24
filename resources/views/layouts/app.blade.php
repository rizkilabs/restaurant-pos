<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel CRUD') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TailwindCSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: Custom Tailwind config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8', // biru
                        danger: '#ef4444',
                        success: '#22c55e',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

    {{-- Navigation bar (optional) --}}
    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-primary">Restaurant App</a>
            <div>
                <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-primary mr-4">Orders</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-primary mr-4">Products</a>
                <a href="{{ route('product-categories.index') }}"
                    class="text-gray-700 hover:text-primary">Categories</a>
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Main content --}}
    <main class="px-4">
        @yield('content')
    </main>

</body>

</html>