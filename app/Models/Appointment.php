<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'student_id', 'advisor_id', 'appointment_date',
        'appointment_time', 'purpose', 'notes', 'advisor_notes', 'status',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }
}
