<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'student_id', 'course_id', 'session', 'semester',
        'score', 'grade', 'grade_points', 'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function scoreToGrade(float $score): array
    {
        return match(true) {
            $score >= 70 => ['grade' => 'A', 'points' => 5],
            $score >= 60 => ['grade' => 'B', 'points' => 4],
            $score >= 50 => ['grade' => 'C', 'points' => 3],
            $score >= 45 => ['grade' => 'D', 'points' => 2],
            $score >= 40 => ['grade' => 'E', 'points' => 1],
            default      => ['grade' => 'F', 'points' => 0],
        };
    }
}
