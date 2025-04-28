<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyApp')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main Content Wrapper --}}
    <div class="md:ml-64 min-h-screen">
        {{-- Optional: Mobile header --}}
        <header class="bg-white shadow-md h-16 flex items-center px-6 md:hidden fixed top-0 left-0 right-0 z-20">
            <div class="text-xl font-semibold text-blue-600">MyApp</div>
        </header>

        {{-- Page Content --}}
        <main class="pt-20 md:pt-6 px-4">
            <div class="max-w-7xl mx-auto">
                {{-- Flash messages --}}
                @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif



</body>

</html>