<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Presentation;
use App\Models\PresentationLike;

class PresentationController extends Controller
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

        if (!$student->group_name) {
            return redirect('/kelompok')->with('error', 'Kamu harus bergabung ke kelompok terlebih dahulu.');
        }

        $student->update([
            'step' => max($student->step, 6),
        ]);

        $myPresentation = Presentation::where('group_name', $student->group_name)->first();

        $presentations = Presentation::with('likes')
            ->latest()
            ->get();

        $likedPresentationIds = PresentationLike::where('student_id', $student->id)
            ->pluck('presentation_id')
            ->toArray();

        return view('presentasi', compact(
            'student',
            'myPresentation',
            'presentations',
            'likedPresentationIds'
        ));
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

        if (!$student->group_name) {
            return redirect('/kelompok')->with('error', 'Kamu harus bergabung ke kelompok terlebih dahulu.');
        }

        $student->update([
            'step' => max($student->step, 6),
        ]);

        $myPresentation = Presentation::where('group_name', $student->group_name)->first();

        $presentations = Presentation::with('likes')
            ->latest()
            ->get();

        $likedPresentationIds = PresentationLike::where('student_id', $student->id)
            ->pluck('presentation_id')
            ->toArray();

        return view('presentasi2', compact(
            'student',
            'myPresentation',
            'presentations',
            'likedPresentationIds'
        ));
    }

    public function index3()
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
            'step' => max($student->step, 6),
        ]);

        $myPresentation = Presentation::where('group_name', $student->group_name)->first();

        $presentations = Presentation::with('likes')
            ->latest()
            ->get();

        $likedPresentationIds = PresentationLike::where('student_id', $student->id)
            ->pluck('presentation_id')
            ->toArray();

        return view('presentasi3', compact(
            'student',
            'myPresentation',
            'presentations',
            'likedPresentationIds'
        ));
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

        if (!$student->group_name) {
            return redirect('/kelompok')->with('error', 'Kamu harus bergabung ke kelompok terlebih dahulu.');
        }

        $request->validate([
            'hypothesis' => 'required|string',
            'pattern' => 'required|string',
            'conclusion' => 'required|string',
        ]);

        Presentation::updateOrCreate(
            [
                'group_name' => $student->group_name,
            ],
            [
                'hypothesis' => $request->hypothesis,
                'pattern' => $request->pattern,
                'conclusion' => $request->conclusion,
            ]
        );

        $student->update([
            'step' => max($student->step, 6),
        ]);

        return redirect('/presentasi')->with('success', 'Hasil presentasi kelompok berhasil dipublikasikan.');
    }

    public function like(Presentation $presentation)
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        PresentationLike::firstOrCreate([
            'student_id' => $student->id,
            'presentation_id' => $presentation->id,
        ]);

        return redirect('/presentasi');
    }

}
