@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <div id="success-message" data-message="{{ session('success') }}"></div>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Users</h1>
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add
                User</a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">Role</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2 capitalize">{{ $user->role }}</td>
                        <td class="p-2">
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button" class="text-red-600 hover:underline delete-button"
                                    data-name="{{ $user->name }}">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const message = document.getElementById('success-message').dataset.message;
        if (message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const name = this.dataset.name;

                Swal.fire({
                    title: `Hapus user "${name}"?`,
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection