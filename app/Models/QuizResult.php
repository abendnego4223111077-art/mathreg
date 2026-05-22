<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'answers',
        'results',
        'correct_count',
        'score',
    ];

    protected $casts = [
        'answers' => 'array',
        'results' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
