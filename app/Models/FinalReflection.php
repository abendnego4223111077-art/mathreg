<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class FinalReflection extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'most_interesting',
        'still_confused',
        'real_life_application',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

