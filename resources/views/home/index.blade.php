@extends('layouts.app')

@section('show_navbar') <!-- Aktifkan navbar -->
@endsection

@section('content')
    <div class="flex items-center justify-center min-h-[calc(100vh-4rem)] bg-gray-100 px-4">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-gray-900">Selamat Datang</h2>
            <a href="{{ route('soal.show', 1) }}"
                class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300">
                Mulai Tryout
            </a>
        </div>
    </div>
@endsection