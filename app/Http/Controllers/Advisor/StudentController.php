<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $students = Auth::user()
            ->advisedStudents()
            ->with('studentProfile')
            ->get();

        return view('advisor.students.index', compact('students'));
    }

    public function show(User $student)
    {
        $advisor = Auth::user();

        if (!$advisor->advisedStudents->contains($student->id)) {
            abort(403);
        }

        $student->load(['studentProfile', 'courses.course', 'appointmentsAsStudent']);

        $totalUnits  = $student->courses->sum(fn($sc) => $sc->course->credit_units ?? 0);
        $earnedUnits = $student->courses->where('status', 'passed')->sum(fn($sc) => $sc->course->credit_units ?? 0);

        $passedData = $student->courses->where('status', 'passed');
        $cgpa = $passedData->count() > 0
            ? round($passedData->sum(fn($sc) => ($sc->grade_points ?? 0) * ($sc->course->credit_units ?? 0)) /
                    max($passedData->sum(fn($sc) => $sc->course->credit_units ?? 0), 1), 2)
            : 0;

        return view('advisor.students.show', compact('student', 'totalUnits', 'earnedUnits', 'cgpa'));
    }
}
