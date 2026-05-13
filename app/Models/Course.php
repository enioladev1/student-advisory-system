<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'title', 'credit_units', 'semester',
        'level', 'department', 'is_compulsory',
    ];

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class);
    }
}
