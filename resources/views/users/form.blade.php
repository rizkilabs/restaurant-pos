<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="border p-2 w-full">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="border p-2 w-full">
    </div>

    <div>
        <label>Password {{ $method === 'POST' ? '' : '(Leave blank to keep current)' }}</label>
        <input type="password" name="password" class="border p-2 w-full">
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
</form>
