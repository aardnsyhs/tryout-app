@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                @method('POST')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="your@email.com" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="••••••••" />
                </div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 hover:cursor-pointer text-white font-medium py-2.5 rounded-lg transition-colors">
                    Login
                </button>
            </form>
            <div class="mt-6 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register.form') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Daftar</a>
            </div>
        </div>
    </div>
@endsection