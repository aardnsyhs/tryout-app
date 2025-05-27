<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TryoutTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Session::start();
        session(['token' => 'access_token']);
    }

    /**
     * A basic feature test example.
     */
    public function test_show_first_question(): void
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/tryout/question' => Http::response([
                'data' => [
                    [
                        'id' => 1,
                        'no_soal' => 1,
                        'soal' => 'Rasa nasionalisme penting dimiliki oleh bangsa Indonesia dalam menghadapi pandemi covid-19. Jika di masa lalu seluruh warga negara Indonesia bersatu untuk berjuang melawan penjajah demi kemerdekaan Indonesia, kini seluruh komponen bangsa berjuang melawan virus covid-19. Sebagai warga negara yang cinta tanah air, nasionalisme pada masa pandemi seperti sekarang ini dapat dilakukan dengan cara berikut, <em>kecuali</em> ....',
                        'tryout_question_option' => [
                            ['id' => 1, 'tryout_question_id' => 1, 'inisial' => 'A', 'jawaban' => 'Menumbuhkan kesadaran dan kedisiplinan dalam diri sendiri dan orang lain supaya patuh dan taat terhadap protokol Kesehatan yang berlaku', 'iscorrect' => 0, 'nilai' => 0],
                            ['id' => 2, 'tryout_question_id' => 1, 'inisial' => 'B', 'jawaban' => 'Meningkatkan kesadaran untuk mematuhi semua anjuran pemerintah dan tidak melaksanakan tindakan yang melanggar', 'iscorrect' => 0, 'nilai' => 0],
                            ['id' => 3, 'tryout_question_id' => 1, 'inisial' => 'C', 'jawaban' => 'Percaya terhadap isu-isu vaksin covid-19 yang bertebaran di media sosial sehingga enggan untuk melakukan vaksinasi', 'iscorrect' => 1, 'nilai' => 5],
                            ['id' => 4, 'tryout_question_id' => 1, 'inisial' => 'D', 'jawaban' => 'Memberikan bantuan seperti makanan dan minuman serta vitamin pada yang terdampak', 'iscorrect' => 0, 'nilai' => 0],
                            ['id' => 5, 'tryout_question_id' => 1, 'inisial' => 'E', 'jawaban' => 'Membangun solidaritas dalam rangka membangun persatuan untuk memutus pandemi covid-19 dan berempati kepada mereka yang terdampak covid', 'iscorrect' => 0, 'nilai' => 0],
                        ]
                    ]
                ]
            ], 200)
        ]);

        $response = $this->withSession(['token' => 'access_token'])->get('/soal/1');
        $response->assertStatus(200);
        $response->assertViewIs('tryout.soal');
        $response->assertViewHas('question', function ($question) {
            return $question['no_soal'] === 1;
        });
    }

    public function test_save_answer_successfull()
    {
        $response = $this->withSession([
            'jawaban' => []
        ])->postJson('/soal/jawab/1', [
                    'answer' => 'C'
                ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => 'Jawaban disimpan.']);
        $this->assertEquals(session('jawaban')[1], 'C');
    }

    public function test_simpan_jawaban_tanpa_pilihan()
    {
        $response = $this->postJson('/soal/jawab/1', []);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Pilih salah satu jawaban.']);
    }

    public function test_report_question_successfull()
    {
        Http::fake([
            'https://api-test.eksam.cloud/api/v1/tryout/lapor-soal/create' => Http::response([
                'data' => [
                    'user_id' => 1,
                    'tryout_question_id' => 1,
                    'laporan' => 'Tes Laporan Soal',
                    'status' => 1,
                    'id' => 1
                ]
            ], 200)
        ]);

        $response = $this->withSession(['token' => 'access_token'])->post('/soal/1/lapor', [
            'tryout_question_id' => 1,
            'laporan' => 'Tes Laporan Soal',
            '_token' => csrf_token()
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Laporan berhasil dikirim.');
    }
}
