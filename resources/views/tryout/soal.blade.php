@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="flex justify-between">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                Soal {{ $question['no_soal'] }}
            </h3>
            <button data-modal-target="report-modal" data-modal-toggle="report-modal"
                class="block text-white bg-red-700 hover:bg-red-800 hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                type="button">
                Laporkan Soal
            </button>
            <div id="report-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Buat Laporan Soal
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="report-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('soal.lapor', $question['id']) }}" class="p-4 md:p-5">
                            @csrf
                            @method('POST')
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="laporan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                    <textarea id="laporan" rows="4" name="laporan"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tuliskan keteranganmu di sini"></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Lapor
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6 text-gray-700">
            {!! $question['soal'] !!}
        </div>
        <div class="space-y-2">
            @foreach ($question['tryout_question_option'] as $option)
                <div class="flex items-center p-4 border border-gray-300 rounded-md">
                    <input id="option-{{ $option['id'] }}" type="radio" name="answer" value="{{ $option['id'] }}"
                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="option-{{ $option['id'] }}" class="w-full ms-3 text-base text-gray-800">
                        <strong>{{ $option['inisial'] }}.</strong> {!! $option['jawaban'] !!}
                    </label>
                </div>
            @endforeach
        </div>
        <hr class="my-6">
        <div class="flex justify-between items-center">
            @if ($no > $min)
                <a href="{{ route('soal.show', $no - 1) }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center justify-center space-x-2">
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span>Back</span>
                </a>
            @else
                <span></span>
            @endif
            @if ($no < $max)
                <a href="{{ route('soal.show', $no + 1) }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center justify-center space-x-2">
                    <span>
                        Next
                    </span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </a>
            @else
                <a href="{{ route('soal.selesai') }}">
                    <button
                        class="block text-white bg-blue-700 hover:bg-blue-800 hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Selesai</button>
                </a>
            @endif
        </div>
    </div>
@endsection