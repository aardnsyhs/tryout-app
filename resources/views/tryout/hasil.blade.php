@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Tryout</h2>
            <p class="text-lg text-gray-700 mb-6">
                Total Nilai Kamu:
                <span class="font-semibold text-indigo-600">{{ $total }}</span>
            </p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 rounded-lg transition-colors hover:cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection