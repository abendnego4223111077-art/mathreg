<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemantikAnswer extends Model
{
    
 protected $fillable = [
        'student_id',
        'answer_1',
        'answer_2',
        'answer_3',
    ];
  
public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
