<aside class="w-64 h-screen bg-white border-r shadow-md fixed top-0 left-0 z-10 hidden md:flex flex-col">
    <div class="h-16 flex items-center justify-center border-b text-xl font-bold text-blue-600">
        MyApp
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
        <a href="{{ route('dashboard') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium transition
                  {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            Dashboard
        </a>

        <a href="{{ route('users.index') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium transition
                  {{ request()->routeIs('users.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            Users
        </a>

        <a href="{{ route('products.index') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium transition
                  {{ request()->routeIs('products.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            Products
        </a>

        <a href="{{ route('product-categories.index') }}"
           class="block px-3 py-2 rounded-md text-sm font-medium transition
                  {{ request()->routeIs('product-categories.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">
            Categories
        </a>
    </nav>

    <div class="border-t p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-red-600 hover:text-red-700 text-sm font-medium px-3 py-2 rounded-md hover:bg-red-50 transition">
                Logout
            </button>
        </form>
    </div>
</aside>
