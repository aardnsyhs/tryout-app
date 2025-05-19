@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Tryout</h2>
            <p class="text-lg text-gray-700 mb-6">
                Total Nilai Kamu:
                <span class="font-semibold text-indigo-600">{{ $total }}</span>
            </p>
            <div class="text-left mb-6 space-y-2">
                <h3 class="font-semibold text-gray-700">Detail Nilai:</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    @foreach ($details as $detail)
                        <li>
                            Soal No {{ $detail['no_soal'] }}:
                            Nilai {{ $detail['nilai'] }}/{{ $detail['max_nilai'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 hover:cursor-pointer text-white font-medium py-2.5 rounded-lg transition-colors hover:cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection