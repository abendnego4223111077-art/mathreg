<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class GroupController extends Controller
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
            'step' => max($student->step, 4),
        ]);

        $groupNames = [
            'Alpha',
            'Beta',
            'Gamma',
            'Delta',
            'Sigma',
        ];

        $groups = collect($groupNames)->map(function ($name) {
            return [
                'name' => $name,
                'count' => Student::where('group_name', $name)->count(),
                'max' => 7,
            ];
        });

        $members = collect();

        if ($student->group_name) {
            $members = Student::where('group_name', $student->group_name)
                ->orderBy('created_at')
                ->get();
        }

        return view('kelompok', compact('student', 'groups', 'members'));
    }

    public function random()
    {
        if (!session('student_id')) {
            return redirect('/');
        }

        $student = Student::find(session('student_id'));

        if (!$student) {
            session()->flush();
            return redirect('/');
        }

        if ($student->group_name) {
            return redirect('/kelompok')->with('success', 'Kamu sudah bergabung di Kelompok ' . $student->group_name . '.');
        }

        $groupNames = [
            'Alpha',
            'Beta',
            'Gamma',
            'Delta',
            'Sigma',
        ];

        $availableGroups = collect($groupNames)->filter(function ($groupName) {
            return Student::where('group_name', $groupName)->count() < 7;
        })->values();

        if ($availableGroups->isEmpty()) {
            return redirect('/kelompok')->with('error', 'Semua kelompok sudah penuh.');
        }

        $chosenGroup = $availableGroups->random();

        $student->update([
            'group_name' => $chosenGroup,
            'step' => max($student->step, 4),
        ]);

        return redirect('/kelompok')->with('group_joined', $chosenGroup);
    }

}
