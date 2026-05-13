<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAdvisor(): bool
    {
        return $this->role === 'advisor';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function advisorProfile()
    {
        return $this->hasOne(AdvisorProfile::class);
    }

    // For advisors: their students
    public function advisedStudents()
    {
        return $this->belongsToMany(User::class, 'advisor_student', 'advisor_id', 'student_id');
    }

    // For students: their advisor
    public function advisors()
    {
        return $this->belongsToMany(User::class, 'advisor_student', 'student_id', 'advisor_id');
    }

    public function courses()
    {
        return $this->hasMany(StudentCourse::class, 'student_id');
    }

    public function appointmentsAsStudent()
    {
        return $this->hasMany(Appointment::class, 'student_id');
    }

    public function appointmentsAsAdvisor()
    {
        return $this->hasMany(Appointment::class, 'advisor_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
