@extends('layouts.app')

@section('title', 'Dashboard Pimpinan')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-600">Role: {{ auth()->user()->role }}</p>
@endsection