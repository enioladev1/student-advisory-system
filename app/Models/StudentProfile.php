<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id', 'matric_number', 'department', 'faculty',
        'program', 'level', 'phone', 'session',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
