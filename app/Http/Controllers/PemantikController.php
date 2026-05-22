<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\PemantikAnswer;

class PemantikController extends Controller
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
            'step' => max($student->step, 3),
        ]);

        $answer = PemantikAnswer::where('student_id', $student->id)->first();

        return view('pemantik', compact('student', 'answer'));
    }

    public function store(Request $request)
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
            'answer_1' => 'required|string',
            'answer_2' => 'required|string',
            'answer_3' => 'required|string',
        ]);

        PemantikAnswer::updateOrCreate(
            [
                'student_id' => $student->id,
            ],
            [
                'answer_1' => $request->answer_1,
                'answer_2' => $request->answer_2,
                'answer_3' => $request->answer_3,
            ]
        );

        $student->update([
            'step' => max($student->step, 3),
        ]);

        return redirect('/kelompok')->with('success', 'Jawaban pemantik berhasil disimpan.');
    }

}
