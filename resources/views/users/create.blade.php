@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-lg font-bold mb-4">Add User</h2>
    @include('users.form', [
        'action' => route('users.store'),
        'method' => 'POST',
        'user' => null
    ])
</div>
@endsection
