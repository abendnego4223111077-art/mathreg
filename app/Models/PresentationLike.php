<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationLike extends Model
{
   
protected $fillable = [
        'student_id',
        'presentation_id',
    ];

}
