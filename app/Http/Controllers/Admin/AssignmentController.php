<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $advisors = User::where('role', 'advisor')
            ->with(['advisorProfile', 'advisedStudents.studentProfile'])
            ->get();

        $unassignedStudents = User::where('role', 'student')
            ->whereDoesntHave('advisors')
            ->with('studentProfile')
            ->get();

        return view('admin.assignments.index', compact('advisors', 'unassignedStudents'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'advisor_id' => ['required', 'exists:users,id'],
            'student_id' => ['required', 'exists:users,id'],
        ]);

        $advisor = User::findOrFail($request->advisor_id);
        $student = User::findOrFail($request->student_id);

        if ($advisor->role !== 'advisor' || $student->role !== 'student') {
            return back()->with('error', 'Invalid user roles.');
        }

        if (!$advisor->advisedStudents->contains($student->id)) {
            $advisor->advisedStudents()->attach($student->id);
        }

        return back()->with('success', "Student assigned to {$advisor->name}.");
    }

    public function unassign(Request $request)
    {
        $request->validate([
            'advisor_id' => ['required', 'exists:users,id'],
            'student_id' => ['required', 'exists:users,id'],
        ]);

        $advisor = User::findOrFail($request->advisor_id);
        $advisor->advisedStudents()->detach($request->student_id);

        return back()->with('success', 'Assignment removed.');
    }
}
