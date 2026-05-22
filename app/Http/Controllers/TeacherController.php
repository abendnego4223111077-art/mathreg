<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\PemantikAnswer;
use App\Models\Presentation;
use App\Models\Lkpd;
use App\Models\QuizResult;
use App\Models\FinalReflection;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function loginPage()
    {
        return view('guru.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if ($request->password !== env('TEACHER_PASSWORD')) {
            return back()->with('error', 'Password guru salah.');
        }

        session([
            'teacher_logged_in' => true,
        ]);

        return redirect('/guru/dashboard');
    }

    public function logout()
    {
        session()->forget('teacher_logged_in');

        return redirect('/guru/login');
    }

    private function guardTeacher()
    {
        if (!session('teacher_logged_in')) {
            return redirect('/guru/login');
        }

        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $totalStudents = Student::count();
        $totalGroups = Student::whereNotNull('group_name')
            ->distinct('group_name')
            ->count('group_name');

        $totalQuiz = QuizResult::count();

        $averageScore = QuizResult::avg('score');
        $averageScore = $averageScore ? round($averageScore, 1) : 0;

        $students = Student::latest()->get();

        return view('guru.dashboard', compact(
            'totalStudents',
            'totalGroups',
            'totalQuiz',
            'averageScore',
            'students'
        ));
    }

    public function students()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $students = Student::latest()->get();

        return view('guru.students', compact('students'));
    }

    public function pemantik()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $answers = PemantikAnswer::with('student')->latest()->get();

        return view('guru.pemantik', compact('answers'));
    }

    public function presentations()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $presentations = Presentation::with('likes')->latest()->get();

        return view('guru.presentations', compact('presentations'));
    }

    public function lkpds()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $lkpds = Lkpd::with('student')->latest()->get();

        return view('guru.lkpds', compact('lkpds'));
    }

    public function quizzes()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $quizzes = QuizResult::with('student')->latest()->get();

        return view('guru.quizzes', compact('quizzes'));
    }

    public function reflections()
    {
        if ($redirect = $this->guardTeacher()) {
            return $redirect;
        }

        $reflections = FinalReflection::with('student')->latest()->get();

        return view('guru.reflections', compact('reflections'));
    }
}