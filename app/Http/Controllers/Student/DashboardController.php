<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['studentProfile', 'advisors.advisorProfile', 'courses.course']);

        $totalCourses   = $user->courses->count();
        $passedCourses  = $user->courses->where('status', 'passed')->count();
        $failedCourses  = $user->courses->whereIn('status', ['failed', 'carry_over'])->count();
        $pendingAppointments = $user->appointmentsAsStudent()->where('status', 'pending')->count();
        $unreadMessages = $user->receivedMessages()->whereNull('read_at')->count();

        $totalUnits = $user->courses->sum(fn($sc) => $sc->course->credit_units ?? 0);
        $earnedUnits = $user->courses->where('status', 'passed')->sum(fn($sc) => $sc->course->credit_units ?? 0);

        $gpaData = $user->courses->where('status', 'passed');
        $gpa = $gpaData->count() > 0
            ? round($gpaData->sum(fn($sc) => ($sc->grade_points ?? 0) * ($sc->course->credit_units ?? 0)) /
                    max($gpaData->sum(fn($sc) => $sc->course->credit_units ?? 0), 1), 2)
            : 0;

        $recentAppointments = $user->appointmentsAsStudent()
            ->with('advisor')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = $user->receivedMessages()
            ->with('sender')
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'user', 'totalCourses', 'passedCourses', 'failedCourses',
            'pendingAppointments', 'unreadMessages', 'totalUnits',
            'earnedUnits', 'gpa', 'recentAppointments', 'recentMessages'
        ));
    }
}
