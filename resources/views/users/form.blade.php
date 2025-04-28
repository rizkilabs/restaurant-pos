<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            value="{{ old('name', $user->name ?? '') }}" 
            required 
            class="border p-2 w-full rounded-md"
        >
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            value="{{ old('email', $user->email ?? '') }}" 
            required 
            class="border p-2 w-full rounded-md"
        >
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
            Password {{ $method === 'POST' ? '' : '(Kosongkan jika tidak diganti)' }}
        </label>
        <input 
            type="password" 
            name="password" 
            id="password"
            class="border p-2 w-full rounded-md"
        >
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Role --}}
    <div>
        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
        <select 
            name="role" 
            id="role"
            class="border p-2 w-full rounded-md"
            required
        >
            <option value="">-- Pilih Role --</option>
            <option value="superadmin" {{ old('role', $user->role ?? '') === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
            <option value="kasir" {{ old('role', $user->role ?? '') === 'kasir' ? 'selected' : '' }}>Kasir</option>
            <option value="pimpinan" {{ old('role', $user->role ?? '') === 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit Button --}}
    <div class="pt-4">
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md w-full">
            Save
        </button>
    </div>
</form>
