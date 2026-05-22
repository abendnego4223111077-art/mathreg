<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\FinalReflection;

class FinalReflectionController extends Controller
{
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
            'most_interesting' => 'required|string',
            'still_confused' => 'required|string',
            'real_life_application' => 'required|string',
        ]);

        FinalReflection::updateOrCreate(
            [
                'student_id' => $student->id,
            ],
            [
                'most_interesting' => $request->most_interesting,
                'still_confused' => $request->still_confused,
                'real_life_application' => $request->real_life_application,
            ]
        );

        $student->update([
            'step' => 10,
        ]);

        return redirect('/selesai')->with('success', 'Jurnal refleksi berhasil disimpan.');
    }

}
