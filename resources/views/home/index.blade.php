@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-4rem)] bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center p-4">
        <div
            class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <div class="bg-indigo-600 py-4 px-6">
                <h1 class="text-2xl font-bold text-white text-center">Selamat Datang di Tryout App</h1>
            </div>
            <div class="p-8 space-y-6">
                <div class="text-center space-y-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-600">Siap menguji kemampuanmu? Mulai tryout sekarang!</p>
                </div>
                <div class="pt-4">
                    <a href="{{ route('soal.show', 1) }}"
                        class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg text-center">
                        Mulai Tryout Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection