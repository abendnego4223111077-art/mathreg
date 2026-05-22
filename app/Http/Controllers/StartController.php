<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StartController extends Controller
{
    public function index()
    {
        return view('start');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'meeting' => 'required|string|max:255',
        ]);

        $student = Student::create([
            'full_name' => $request->full_name,
            'meeting' => $request->meeting,
            'step' => 1,
        ]);

        session([
            'student_id' => $student->id,
            'student_name' => $student->full_name,
        ]);

        if ($request->meeting === 'Pertemuan 3') {
            return redirect()->route('petunjuk3');
        }

        if ($request->meeting === '2' || $request->meeting === 'Pertemuan 2') {
            return redirect()->route('petunjuk3');
        }

        return redirect()->route('petunjuk');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/');
    }

}
