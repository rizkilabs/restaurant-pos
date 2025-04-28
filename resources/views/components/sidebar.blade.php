<aside class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white p-4 space-y-4 z-30">
    <h2 class="text-2xl font-bold mb-6">RestoPOS</h2>

    @php
        $role = auth()->user()->role;
    @endphp

    {{-- Menu untuk semua user: Dashboard --}}
    <a href="{{ 
        $role === 'superadmin' ? route('admin.dashboard') : 
        ($role === 'kasir' ? route('cashier.dashboard') : 
        route('pimpinan.dashboard')) 
    }}" class="block py-2 px-3 rounded hover:bg-gray-700">
        Dashboard
    </a>

    {{-- Menu khusus Superadmin --}}
    @if($role === 'superadmin')
        <a href="{{ route('products.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Data Produk</a>
        <a href="{{ route('users.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Manajemen User</a>
        <a href="{{ route('orders.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Data Order</a>
    @endif

    {{-- Menu khusus Kasir --}}
    @if($role === 'kasir')
        <a href="{{ route('cashier.create') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Transaksi Baru</a>
        <a href="{{ route('products.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Data Produk</a>
    @endif

    {{-- Menu khusus Pimpinan --}}
    @if($role === 'pimpinan' || $role === 'superadmin')
        <div class="mt-6">
            <p class="text-sm text-gray-400 mb-2">Laporan Penjualan</p>
            <a href="{{ route('pimpinan.reports.harian') }}" class="block hover:text-yellow-300">Harian</a>
            <a href="{{ route('pimpinan.reports.mingguan') }}" class="block hover:text-yellow-300">Mingguan</a>
            <a href="{{ route('pimpinan.reports.bulanan') }}" class="block hover:text-yellow-300">Bulanan</a>
            <a href="{{ route('pimpinan.reports.filter') }}" class="block hover:text-yellow-300">Filter</a>
        </div>
    @endif

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded w-full" type="submit">
            Logout
        </button>
    </form>
</aside>
