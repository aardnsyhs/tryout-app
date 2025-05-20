@extends('layouts.app')

@section('show_navbar') <!-- Aktifkan navbar -->
@endsection

@section('content')
    <div class="flex items-center justify-center min-h-[calc(100vh-4rem)] bg-gradient-to-br from-blue-50 to-white">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 text-center space-y-3">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Hasil Tryout</h2>
                <p class="mt-2 text-gray-500 text-sm">Cek hasil jawaban kamu di bawah ini</p>
            </div>
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl py-4">
                <p class="text-lg text-gray-700">Total Nilai Kamu:</p>
                <p class="text-3xl font-extrabold text-indigo-600 mt-1">{{ $total }}</p>
            </div>
            <div class="text-left">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Detail Nilai:</h3>
                <ul class="space-y-2">
                    @foreach ($details as $detail)
                        <li
                            class="flex justify-between px-4 py-2 bg-gray-50 rounded-md border border-gray-200 text-sm text-gray-700">
                            <span>Soal No {{ $detail['no_soal'] }}</span>
                            <span>{{ $detail['nilai'] }}/{{ $detail['max_nilai'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection