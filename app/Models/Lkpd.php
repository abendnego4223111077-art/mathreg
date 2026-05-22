<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Lkpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',

        'scatter_pattern',
        'scatter_relation',

        'manual_intercept',
        'manual_slope',
        'manual_line_reason',
        'outlier_reason',

        'sum_x',
        'sum_y',
        'sum_x2',
        'sum_xy',

        'ols_intercept',
        'ols_slope',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
