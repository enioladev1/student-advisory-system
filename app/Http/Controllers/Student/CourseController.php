<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $courses = $user->courses()->with('course')->get()->groupBy('semester');

        $totalUnits  = $user->courses->sum(fn($sc) => $sc->course->credit_units ?? 0);
        $earnedUnits = $user->courses->where('status', 'passed')->sum(fn($sc) => $sc->course->credit_units ?? 0);

        $passedData = $user->courses->where('status', 'passed');
        $cgpa = $passedData->count() > 0
            ? round($passedData->sum(fn($sc) => ($sc->grade_points ?? 0) * ($sc->course->credit_units ?? 0)) /
                    max($passedData->sum(fn($sc) => $sc->course->credit_units ?? 0), 1), 2)
            : 0;

        return view('student.courses.index', compact('courses', 'totalUnits', 'earnedUnits', 'cgpa'));
    }
}
