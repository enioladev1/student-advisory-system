<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisorProfile extends Model
{
    protected $fillable = [
        'user_id', 'staff_id', 'department', 'faculty',
        'phone', 'bio', 'max_students',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
