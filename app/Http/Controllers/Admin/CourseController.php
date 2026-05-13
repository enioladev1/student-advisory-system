<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'         => ['required', 'string', 'max:20', 'unique:courses'],
            'title'        => ['required', 'string', 'max:255'],
            'credit_units' => ['required', 'integer', 'min:1', 'max:6'],
            'semester'     => ['required', 'in:First,Second'],
            'level'        => ['required', 'in:100,200,300,400'],
            'department'   => ['required', 'string', 'max:255'],
            'is_compulsory'=> ['boolean'],
        ]);

        Course::create($request->only([
            'code', 'title', 'credit_units', 'semester', 'level', 'department', 'is_compulsory'
        ]));

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }
}
