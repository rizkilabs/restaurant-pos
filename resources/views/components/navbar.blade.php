<nav class="bg-white border-b shadow px-6 py-4 flex justify-between items-center">
    <span class="text-lg font-semibold">Hello, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-red-500 hover:underline">Logout</button>
    </form>
</nav>
