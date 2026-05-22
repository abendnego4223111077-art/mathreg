<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
  
 protected $fillable = [
        'group_name',
        'hypothesis',
        'pattern',
        'conclusion',
    ];

    public function likes()
    {
        return $this->hasMany(PresentationLike::class);
    }

}
