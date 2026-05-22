<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Lkpd;
use App\Models\QuizResult;
use App\Models\FinalReflection;

class LearningController extends Controller
{
    public function petunjuk()
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
            'step' => max($student->step, 1),
        ]);

        return view('petunjuk', compact('student'));
    }

    public function petunjuk2()
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
            'step' => max($student->step, 1),
        ]);

        return view('petunjuk2', compact('student'));
    }

    public function petunjuk3()
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
            'step' => max($student->step, 1),
        ]);

        return view('petunjuk3', compact('student'));
    }

    public function petunjuk4()
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
            'step' => max($student->step, 1),
        ]);

        return view('petunjuk4', compact('student'));
    }

    public function tujuan2()
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
            'step' => max($student->step, 2),
        ]);

        return view('tujuan2', compact('student'));
    }

    public function tujuan()
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
            'step' => max($student->step, 2),
        ]);

        $objectives = [
            'Memahami konsep hubungan dua variabel melalui data bivariat.',
            'Mengidentifikasi pola hubungan data menggunakan diagram pencar atau scatter plot.',
            'Membuat hipotesis berdasarkan data yang diamati.',
            'Memahami konsep garis perkiraan sebagai representasi hubungan data.',
            'Memahami ide dasar Metode Kuadrat Terkecil atau OLS.',
            'Menginterpretasikan koefisien slope dan intercept pada model regresi linear.',
            'Membuat prediksi sederhana menggunakan model regresi linear.',
            'Menggunakan teknologi digital untuk eksplorasi dan analisis data.',
        ];

        return view('tujuan', compact('student', 'objectives'));
    }

    public function orientasi()
    {
        if (!session('student_id')) {
        return redirect('/');
    }

    $student = Student::find(session('student_id'));

    if (!$student) {
        session()->flush();
        return redirect('/');
    }

    if (!$student->group_name) {
        return redirect('/kelompok')->with('error', 'Kamu harus bergabung ke kelompok terlebih dahulu.');
    }

    $student->update([
        'step' => max($student->step, 5),
    ]);

    $data = [
        ['x' => 6,  'y' => 1.0],
        ['x' => 8,  'y' => 1.3],
        ['x' => 10, 'y' => 1.7],
        ['x' => 12, 'y' => 2.0],
        ['x' => 14, 'y' => 2.3],
    ];

    $concepts = [
        [
            'title' => 'Data Bivariat',
            'description' => 'Data yang terdiri dari dua variabel, yaitu X dan Y.',
        ],
        [
            'title' => 'Scatter Plot',
            'description' => 'Diagram pencar untuk melihat pola hubungan antara dua variabel.',
        ],
        [
            'title' => 'Regresi Linear',
            'description' => 'Model matematika berbentuk garis lurus untuk menjelaskan hubungan X dan Y.',
        ],
        [
            'title' => 'OLS',
            'description' => 'Metode kuadrat terkecil untuk mencari garis terbaik.',
        ],
        [
            'title' => 'Prediksi',
            'description' => 'Menggunakan persamaan regresi untuk memperkirakan nilai Y berdasarkan X.',
        ],
    ];

    return view('orientasi', compact('student', 'data', 'concepts'));
    }

    public function orientasi2()
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        if (!$student->group_name) {
            return redirect('/kelompok')->with('error', 'Kamu harus bergabung ke kelompok terlebih dahulu.');
        }

        $student->update([
            'step' => max($student->step, 5),
        ]);

        return view('orientasi2', compact('student'));
    }

    public function evaluasi()
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
        'step' => max($student->step, 7),
    ]);

    $concepts = [
        [
            'id' => 1,
            'title' => 'Regresi Linear',
            'short' => 'Model garis lurus untuk melihat hubungan X dan Y.',
            'icon' => '📈',
        ],
        [
            'id' => 2,
            'title' => 'Residu',
            'short' => 'Selisih antara nilai aktual dan nilai prediksi.',
            'icon' => '📍',
        ],
        [
            'id' => 3,
            'title' => 'Metode Kuadrat Terkecil (OLS)',
            'short' => 'Metode untuk mencari garis terbaik.',
            'icon' => '🧮',
        ],
        [
            'id' => 4,
            'title' => 'Interpretasi Koefisien',
            'short' => 'Menjelaskan makna slope dan intercept.',
            'icon' => '🔎',
        ],
    ];

    return view('evaluasi', compact('student', 'concepts'));
    }

    public function selesai()
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
            'step' => max($student->step, 10),
        ]);

        $lkpd = Lkpd::where('student_id', $student->id)->first();

        $quizResult = QuizResult::where('student_id', $student->id)
            ->latest()
            ->first();

        $finalReflection = FinalReflection::where('student_id', $student->id)->first();

        return view('selesai', compact(
            'student',
            'lkpd',
            'quizResult',
            'finalReflection'
        ));
    }

    public function selesai2()
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
            'step' => max($student->step, 10),
        ]);

        $lkpd = Lkpd::where('student_id', $student->id)->first();

        $quizResult = QuizResult::where('student_id', $student->id)
            ->latest()
            ->first();

        $finalReflection = FinalReflection::where('student_id', $student->id)->first();

        return view('selesai2', compact(
            'student',
            'lkpd',
            'quizResult',
            'finalReflection'
        ));
    }
}

