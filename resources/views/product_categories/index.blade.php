@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-4">
        <div id="success-message" data-message="{{ session('success') }}"></div>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Product Categories</h1>
            <a href="{{ route('product-categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add Category</a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td class="p-2">{{ $index + 1 }}</td>
                        <td class="p-2">{{ $category->name }}</td>
                        <td class="p-2">
                            <a href="{{ route('product-categories.edit', $category) }}"
                                class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('product-categories.destroy', $category) }}" method="POST"
                                class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button" class="text-red-600 hover:underline delete-button"
                                    data-name="{{ $category->name }}">
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
                    title: `Hapus kategori "${name}"?`,
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