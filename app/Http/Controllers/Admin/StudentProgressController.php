<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Http\Request;

class StudentProgressController extends Controller
{
    public function show(User $student)
    {
        if ($student->role !== 'student') {
            abort(404);
        }

        $student->load(['studentProfile', 'courses.course']);

        $totalUnits  = $student->courses->sum(fn($sc) => $sc->course->credit_units ?? 0);
        $earnedUnits = $student->courses->where('status', 'passed')->sum(fn($sc) => $sc->course->credit_units ?? 0);

        $passedData = $student->courses->where('status', 'passed');
        $cgpa = $passedData->count() > 0
            ? round($passedData->sum(fn($sc) => ($sc->grade_points ?? 0) * ($sc->course->credit_units ?? 0)) /
                    max($passedData->sum(fn($sc) => $sc->course->credit_units ?? 0), 1), 2)
            : 0;

        $availableCourses = Course::where('department', $student->studentProfile->department ?? '')->get();

        return view('admin.students.progress', compact('student', 'totalUnits', 'earnedUnits', 'cgpa', 'availableCourses'));
    }

    public function updateScore(Request $request, User $student)
    {
        $request->validate([
            'course_id'  => ['required', 'exists:courses,id'],
            'session'    => ['required', 'string'],
            'semester'   => ['required', 'in:First,Second'],
            'score'      => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $gradeInfo = StudentCourse::scoreToGrade($request->score);

        $status = $gradeInfo['grade'] === 'F' ? 'failed' : 'passed';

        StudentCourse::updateOrCreate(
            [
                'student_id' => $student->id,
                'course_id'  => $request->course_id,
                'session'    => $request->session,
                'semester'   => $request->semester,
            ],
            [
                'score'        => $request->score,
                'grade'        => $gradeInfo['grade'],
                'grade_points' => $gradeInfo['points'],
                'status'       => $status,
            ]
        );

        return back()->with('success', 'Score recorded.');
    }
}
