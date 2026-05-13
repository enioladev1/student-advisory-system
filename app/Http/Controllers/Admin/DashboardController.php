<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Course;
use App\Models\Message;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents  = User::where('role', 'student')->count();
        $totalAdvisors  = User::where('role', 'advisor')->count();
        $totalCourses   = Course::count();
        $totalMessages  = Message::count();
        $pendingAppts   = Appointment::where('status', 'pending')->count();

        $recentStudents = User::where('role', 'student')
            ->with('studentProfile')
            ->latest()
            ->take(5)
            ->get();

        $recentAppointments = Appointment::with(['student', 'advisor'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalAdvisors', 'totalCourses',
            'totalMessages', 'pendingAppts', 'recentStudents', 'recentAppointments'
        ));
    }
}
