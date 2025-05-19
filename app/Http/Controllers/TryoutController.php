<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TryoutController extends Controller
{
    public function index()
    {
        return redirect()->route('soal.show', 1);
    }

    public function show($no)
    {
        if (!session()->has('questions')) {
            $response = Http::withToken(session('token'))->get('https://api-test.eksam.cloud/api/v1/tryout/question');
            session(['questions' => $response->json('data')]);
        }

        $questions = collect(session('questions'));
        $question = $questions->firstWhere('no_soal', (int) $no);
        if (!$question)
            abort(404);

        $min = $questions->min('no_soal');
        $max = $questions->max('no_soal');

        return view('tryout.soal', compact('question', 'no', 'min', 'max'));
    }

    public function lapor(Request $request, $id)
    {
        $request->validate([
            'laporan' => 'required|string|max:255',
        ]);

        Http::withToken(session('token'))->post('https://api-test.eksam.cloud/api/v1/tryout/lapor-soal/create', [
            'tryout_question_id' => $id,
            'laporan' => $request->laporan,
        ]);

        return back()->with('success', 'Laporan berhasil dikirim.');
    }

    public function simpanJawaban(Request $request, $questionId)
    {
        $data = $request->all();

        if ($request->isJson()) {
            $data = $request->json()->all();
        }

        $answer = $data['answer'] ?? null;

        if (!$answer) {
            return response()->json(['error' => 'Pilih salah satu jawaban.'], 400);
        }

        $jawabanSebelumnya = session('jawaban', []);
        $jawabanSebelumnya[$questionId] = $answer;
        session(['jawaban' => $jawabanSebelumnya]);

        return response()->json(['success' => 'Jawaban disimpan.']);
    }

    public function selesai()
    {
        $jawaban = session('jawaban', []);
        $questions = collect(session('questions', []));

        $soalBelumDijawab = [];

        foreach ($questions as $question) {
            if (!isset($jawaban[$question['id']])) {
                $soalBelumDijawab[] = $question['no_soal'];
            }
        }

        if (count($soalBelumDijawab) > 0) {
            $nomorPertamaKosong = $soalBelumDijawab[0];
            return redirect()->route('soal.show', $nomorPertamaKosong)
                ->with('error', 'Masih ada soal yang belum dijawab: ' . implode(', ', $soalBelumDijawab));
        }

        $total = 0;
        $details = [];

        foreach ($questions as $question) {
            $selectedOptionId = $jawaban[$question['id']];
            $option = collect($question['tryout_question_option'])->firstWhere('id', $selectedOptionId);
            $nilai = $option['nilai'] ?? 0;
            $total += $nilai;

            $details[] = [
                'no_soal' => $question['no_soal'],
                'nilai' => $nilai,
                'max_nilai' => collect($question['tryout_question_option'])->max('nilai') ?? 0,
            ];
        }

        return view('tryout.hasil', compact('total', 'details'));
    }
}
