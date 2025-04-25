<aside class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white p-4 space-y-4 z-30">
    <h2 class="text-2xl font-bold mb-6">Menu</h2>

    @if(auth()->user()->role === 'superadmin')
    {{-- menu admin --}}
    @elseif(auth()->user()->role === 'kasir')
    <a href="{{ route('cashier.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Cashier</a>
    <a href="{{ route('products.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Data Produk</a>
    @elseif(auth()->user()->role === 'pimpinan')
    <a href="{{ route('pimpinan.dashboard') }}" class="block hover:text-yellow-300">Dashboard</a>
    <a href="{{ route('products.index') }}" class="block hover:text-yellow-300">Produk</a>
    <div>
        <p class="text-sm text-gray-400 mt-4">Laporan Penjualan</p>
        <a href="{{ route('laporan.harian') }}" class="block hover:text-yellow-300">Harian</a>
        <a href="{{ route('laporan.mingguan') }}" class="block hover:text-yellow-300">Mingguan</a>
        <a href="{{ route('laporan.bulanan') }}" class="block hover:text-yellow-300">Bulanan</a>
    </div>
    @endif

</aside>