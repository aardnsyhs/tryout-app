@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            @method('POST')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required placeholder="Masukkan Nama Anda">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') ?? '' }}"
                    class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required placeholder="email@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required placeholder="••••••••">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 hover:cursor-pointer text-white font-medium py-2.5 rounded-lg transition-colors">
                Register
            </button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login.form') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Masuk</a>
        </div>
    </div>
</div>
@endsection