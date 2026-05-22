<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Lkpd;

class LkpdController extends Controller
{
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
            'step' => max($student->step, 8),
        ]);

        $lkpd = Lkpd::where('student_id', $student->id)->first();

        $data = [
            ['x' => 6,  'y' => 1.0, 'x2' => 36,  'xy' => 6.0],
            ['x' => 8,  'y' => 1.3, 'x2' => 64,  'xy' => 10.4],
            ['x' => 10, 'y' => 1.7, 'x2' => 100, 'xy' => 17.0],
            ['x' => 12, 'y' => 2.0, 'x2' => 144, 'xy' => 24.0],
            ['x' => 14, 'y' => 2.3, 'x2' => 196, 'xy' => 32.2],
        ];

        $totals = [
            'sum_x' => 50,
            'sum_y' => 8.3,
            'sum_x2' => 540,
            'sum_xy' => 89.6,
        ];

        return view('lkpd', compact('student', 'lkpd', 'data', 'totals'));
    }

    public function saveScatter(Request $request)
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
            'scatter_pattern' => 'required|string',
            'scatter_relation' => 'required|string',
        ]);

        Lkpd::updateOrCreate(
            ['student_id' => $student->id],
            [
                'scatter_pattern' => $request->scatter_pattern,
                'scatter_relation' => $request->scatter_relation,
            ]
        );

        return redirect('/lkpd')->with('success', 'Jawaban scatter berhasil disimpan.');
    }

    public function saveManualLine(Request $request)
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
            'manual_intercept' => 'required|numeric',
            'manual_slope' => 'required|numeric',
            'manual_line_reason' => 'required|string',
            'outlier_reason' => 'required|string',
        ]);

        Lkpd::updateOrCreate(
            ['student_id' => $student->id],
            [
                'manual_intercept' => $request->manual_intercept,
                'manual_slope' => $request->manual_slope,
                'manual_line_reason' => $request->manual_line_reason,
                'outlier_reason' => $request->outlier_reason,
            ]
        );

        return redirect('/lkpd')->with('success', 'Garis manual berhasil disimpan.');
    }

    public function calculateOls(Request $request)
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
            'sum_x' => 'required|numeric',
            'sum_y' => 'required|numeric',
            'sum_x2' => 'required|numeric',
            'sum_xy' => 'required|numeric',
        ]);

        $n = 5;

        $sumX = (float) $request->sum_x;
        $sumY = (float) $request->sum_y;
        $sumX2 = (float) $request->sum_x2;
        $sumXY = (float) $request->sum_xy;

        $denominator = ($n * $sumX2) - ($sumX * $sumX);

        if ($denominator == 0) {
            return redirect('/lkpd')->with('error', 'Perhitungan tidak valid karena penyebut bernilai 0.');
        }

        // b = (nΣxy - ΣxΣy) / (nΣx² - (Σx)²)
        $b = (($n * $sumXY) - ($sumX * $sumY)) / $denominator;

        // a = (Σy - bΣx) / n
        $a = ($sumY - ($b * $sumX)) / $n;

        Lkpd::updateOrCreate(
            ['student_id' => $student->id],
            [
                'sum_x' => $sumX,
                'sum_y' => $sumY,
                'sum_x2' => $sumX2,
                'sum_xy' => $sumXY,
                'ols_intercept' => $a,
                'ols_slope' => $b,
            ]
        );

        $student->update([
            'step' => max($student->step, 8),
        ]);

        return redirect('/lkpd')->with([
            'success' => 'Perhitungan OLS berhasil disimpan.',
            'ols_result' => true,
            'a' => round($a, 3),
            'b' => round($b, 3),
        ]);
    }

}
