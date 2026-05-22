<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\QuizResult;

class QuizController extends Controller
{
    private function questions()
    {
        return [
            [
                'question' => 'Diagram pencar atau scatter plot digunakan untuk...',
                'options' => [
                    'A' => 'Menghitung rata-rata data',
                    'B' => 'Menunjukkan pola hubungan antara dua variabel',
                    'C' => 'Mencari nilai tengah data',
                    'D' => 'Mengurutkan data dari kecil ke besar',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Jika nilai X meningkat dan nilai Y juga meningkat, maka hubungan tersebut disebut...',
                'options' => [
                    'A' => 'Hubungan negatif',
                    'B' => 'Hubungan positif',
                    'C' => 'Hubungan acak',
                    'D' => 'Tidak ada hubungan',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Bentuk umum persamaan regresi linear sederhana adalah...',
                'options' => [
                    'A' => 'ŷ = a + bx',
                    'B' => 'ŷ = ax² + b',
                    'C' => 'x = a + by',
                    'D' => 'y = x / a',
                ],
                'correct' => 'A',
            ],
            [
                'question' => 'Slope atau koefisien b menunjukkan...',
                'options' => [
                    'A' => 'Jumlah seluruh data',
                    'B' => 'Nilai rata-rata data',
                    'C' => 'Perubahan Y setiap X naik 1 satuan',
                    'D' => 'Nilai terkecil dari data',
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Intercept atau a dalam persamaan regresi adalah...',
                'options' => [
                    'A' => 'Nilai Y saat X = 0',
                    'B' => 'Nilai X saat Y = 0',
                    'C' => 'Jumlah semua nilai X',
                    'D' => 'Jumlah semua nilai Y',
                ],
                'correct' => 'A',
            ],
            [
                'question' => 'Metode Kuadrat Terkecil atau OLS bertujuan untuk...',
                'options' => [
                    'A' => 'Membuat data menjadi acak',
                    'B' => 'Meminimalkan jumlah kuadrat error',
                    'C' => 'Menghapus titik data',
                    'D' => 'Menentukan median data',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Residu adalah...',
                'options' => [
                    'A' => 'Nilai prediksi dari model',
                    'B' => 'Nilai rata-rata data',
                    'C' => 'Selisih antara nilai aktual dan nilai prediksi',
                    'D' => 'Jumlah seluruh data',
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Jika slope bernilai negatif, maka garis regresi cenderung...',
                'options' => [
                    'A' => 'Naik dari kiri ke kanan',
                    'B' => 'Turun dari kiri ke kanan',
                    'C' => 'Datar sempurna',
                    'D' => 'Tidak dapat digambar',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Pasangan data pada scatter plot biasanya ditulis sebagai...',
                'options' => [
                    'A' => '(x, y)',
                    'B' => '(a, b)',
                    'C' => '(mean, median)',
                    'D' => '(min, max)',
                ],
                'correct' => 'A',
            ],
            [
                'question' => 'Model regresi linear dapat digunakan untuk...',
                'options' => [
                    'A' => 'Memprediksi nilai Y berdasarkan nilai X',
                    'B' => 'Menghapus semua data',
                    'C' => 'Mengganti data asli',
                    'D' => 'Membuat data tidak beraturan',
                ],
                'correct' => 'A',
            ],
        ];
    }

    public function index()
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        $student->update([
            'step' => max($student->step, 9),
        ]);

        $questions = $this->questions();
        $quizVariant = 1;

        return view('kuis', compact('student', 'questions', 'quizVariant'));
    }

    public function index2()
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        $student->update([
            'step' => max($student->step, 9),
        ]);

        $questions = $this->questions2();
        $quizVariant = 2;

        return view('kuis', compact('student', 'questions', 'quizVariant'));
    }

    private function questions2()
    {
        return [
            [
                'question' => 'Dari data pupuk dan hasil panen diperoleh persamaan regresi ŷ = 0.7 + 0.0240x. Berapa prediksi hasil panen (ton/ha) jika jumlah pupuk yang digunakan adalah 160 kg/ha?',
                'options' => [
                    'A' => '3.84 ton/ha',
                    'B' => '4.14 ton/ha',
                    'C' => '4.54 ton/ha',
                    'D' => '5.14 ton/ha',
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Persamaan regresi dibentuk dari data dengan rentang x antara 50 hingga 225 kg/ha. Jika model digunakan untuk memprediksi hasil panen pada x = 300 kg/ha, maka prediksi tersebut dikategorikan sebagai...',
                'options' => [
                    'A' => 'Interpolasi, karena menggunakan model yang sama',
                    'B' => 'Ekstrapolasi, karena x = 300 berada di luar rentang data [50, 225]',
                    'C' => 'Interpolasi, karena hasilnya masih dalam satuan ton/ha',
                    'D' => 'Ekstrapolasi, karena nilai x lebih besar dari rata-rata data',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Pada persamaan regresi ŷ = 0.7 + 0.0240x (x = pupuk kg/ha, ŷ = panen ton/ha), interpretasi yang tepat untuk koefisien slope b = 0.0240 adalah...',
                'options' => [
                    'A' => 'Setiap penambahan 1 ton/ha panen, pupuk bertambah 0.0240 kg/ha',
                    'B' => 'Hasil panen awal tanpa pupuk adalah 0.0240 ton/ha',
                    'C' => 'Setiap penambahan 1 kg/ha pupuk, hasil panen rata-rata meningkat 0.0240 ton/ha',
                    'D' => 'Model regresi memiliki akurasi sebesar 2.4%'
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Mengapa prediksi hasil panen pada dosis pupuk 300 kg/ha perlu ditafsirkan dengan sangat hati-hati, meskipun secara matematis nilai tersebut dapat dihitung dari persamaan regresi?',
                'options' => [
                    'A' => 'Karena persamaan regresi hanya berlaku untuk bilangan bulat',
                    'B' => 'Karena pupuk sebanyak 300 kg/ha terlalu mahal secara ekonomi',
                    'C' => 'Karena model regresi dibangun dari data dalam rentang 50–225 kg/ha, sehingga asumsi linearitas belum tentu berlaku di luar rentang tersebut',
                    'D' => 'Karena satuan pengukurannya berbeda',
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Pernyataan: "Interpolasi adalah prediksi nilai y untuk x yang berada di luar rentang data observasi yang digunakan untuk membangun model regresi."',
                'options' => [
                    'A' => 'BENAR',
                    'B' => 'SALAH',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Diberikan data: n=6, Σx=600, Σy=72, Σx²=68000, Σxy=8100. Tentukan nilai slope b dari persamaan regresi linear!',
                'options' => [
                    'A' => 'b = 0.10',
                    'B' => 'b = 0.1125',
                    'C' => 'b = 0.15',
                    'D' => 'b = 1.25',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Persamaan regresi ŷ = 0.7 + 0.024x diperoleh dari data pupuk-panen. Nilai intercept a = 0.7 diinterpretasikan sebagai...',
                'options' => [
                    'A' => 'Kemiringan garis regresi terhadap sumbu-x',
                    'B' => 'Koefisien korelasi antara pupuk dan hasil panen',
                    'C' => 'Prediksi hasil panen (0.7 ton/ha) ketika tidak ada pupuk yang diberikan (x = 0)',
                    'D' => 'Rata-rata hasil panen dari seluruh data',
                ],
                'correct' => 'C',
            ],
            [
                'question' => 'Seorang content creator menemukan bahwa hubungan antara jam upload (x, dalam jam ke-berapa dari tengah malam) dan views (y, ribuan) mengikuti persamaan ŷ = 5.2 + 2.8x. Data dikumpulkan dari konten yang diupload antara pukul 06.00–20.00 (x = 6 hingga 20). Berapakah prediksi views untuk konten yang diupload pukul 13.00?',
                'options' => [
                    'A' => '38.6 ribu views',
                    'B' => '41.6 ribu views',
                    'C' => '33.8 ribu views',
                    'D' => '44.4 ribu views',
                ],
                'correct' => 'B',
            ],
            [
                'question' => 'Pernyataan: "Semakin jauh nilai x dari rentang data observasi, semakin besar pula ketidakpastian prediksi ekstrapolasi yang dihasilkan oleh model regresi linear."',
                'options' => [
                    'A' => 'BENAR',
                    'B' => 'SALAH',
                ],
                'correct' => 'A',
            ],
            [
                'question' => 'Persamaan regresi ŷ = 0.7 + 0.024x digunakan untuk memprediksi data (x=100, y=3.4). Berapakah nilai residu untuk data ini? Apa artinya jika residu bernilai positif?',
                'options' => [
                    'A' => 'Residu = -0.3; nilai aktual lebih kecil dari prediksi',
                    'B' => 'Residu = +0.3; nilai aktual (3.4) lebih besar dari prediksi ŷ(100) = 3.1',
                    'C' => 'Residu = 0; titik tepat pada garis regresi',
                    'D' => 'Residu = 3.4; sama dengan nilai y aktual',
                ],
                'correct' => 'B',
            ],
        ];
    }

    public function submit(Request $request)
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        $request->validate([
            'quiz_variant' => 'nullable|in:1,2',
            'answers' => 'required|array',
        ]);

        $quizVariant = $request->input('quiz_variant') === '2' ? 2 : 1;
        $questions = $quizVariant === 2 ? $this->questions2() : $this->questions();

        $answers = $request->answers;

        $correctCount = 0;
        $results = [];

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? null;
            $correctAnswer = $question['correct'];
            $isCorrect = $userAnswer === $correctAnswer;

            if ($isCorrect) {
                $correctCount++;
            }

            $results[] = [
                'number' => $index + 1,
                'question' => $question['question'],
                'options' => $question['options'],
                'user_answer' => $userAnswer,
                'correct_answer' => $correctAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        $score = $correctCount * 10;

        $quizResult = QuizResult::create([
            'student_id' => $student->id,
            'answers' => $answers,
            'results' => $results,
            'correct_count' => $correctCount,
            'score' => $score,
        ]);

        $student->update([
            'step' => max($student->step, 9),
        ]);

        $route = $request->input('quiz_variant') === '2' ? 'kuis2.result' : 'kuis.result';

        return redirect()->route($route, $quizResult->id);
    }

    public function result(QuizResult $quizResult)
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        if ($quizResult->student_id !== $student->id) {
            return redirect('/kuis');
        }

        return view('hasil-kuis', compact('student', 'quizResult'));
    }

    public function result2(QuizResult $quizResult)
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        if ($quizResult->student_id !== $student->id) {
            return redirect('/kuis2');
        }

        return view('hasil-kuis2', compact('student', 'quizResult'));
    }

}
