@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto md:mt-5 bg-white p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-xl font-semibold text-gray-800">
                Soal {{ $question['no_soal'] }}
            </h3>
            <button data-modal-target="report-modal" data-modal-toggle="report-modal"
                class="block text-white bg-rose-500 hover:bg-rose-600 hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2 text-center"
                type="button">
                Laporkan Soal
            </button>
        </div>
        <x-report-modal :question-id="$question['id']" />
        <div class="mb-6 text-gray-700">
            {!! $question['soal'] !!}
        </div>

        <div class="space-y-2">
            @foreach ($question['tryout_question_option'] as $option)
                @php
                    $selected = session('jawaban')[$question['id']] ?? null;
                @endphp
                <label for="option-{{ $option['id'] }}"
                    class="flex items-center gap-3 p-4 border border-gray-300 rounded-md cursor-pointer transition-all has-[:checked]:border-blue-600 has-[:checked]:text-blue-600">

                    <input id="option-{{ $option['id'] }}" type="radio" name="answer" value="{{ $option['id'] }}"
                        data-question-id="{{ $question['id'] }}"
                        class="auto-save w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 checked:bg-blue-600 shrink-0"
                        @if((string) $selected === (string) $option['id']) checked @endif>

                    <span class="text-base leading-relaxed">
                        <strong>{{ $option['inisial'] }}.</strong> {!! $option['jawaban'] !!}
                    </span>
                </label>
            @endforeach
        </div>

        <div class="flex justify-between items-center mt-6">
            @if ($no > $min)
                <a href="{{ route('soal.show', $no - 1) }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center space-x-2">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" d="M5 1 1 5l4 4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Back</span>
                </a>
            @else
                <span></span>
            @endif

            @if ($no < $max)
                <a href="{{ route('soal.show', $no + 1) }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center space-x-2">
                    <span>Next</span>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" d="m1 9 4-4-4-4" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            @else
                <a href="{{ route('soal.selesai') }}">
                    <button type="button"
                        class="text-white bg-indigo-700 hover:cursor-pointer hover:bg-indigo-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Selesai
                    </button>
                </a>
            @endif
        </div>
    </div>
@endsection