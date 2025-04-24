@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-lg font-bold mb-4">Edit User</h2>
    @include('users.form', [
        'action' => route('users.update', $user),
        'method' => 'PUT',
        'user' => $user
    ])
</div>
@endsection
