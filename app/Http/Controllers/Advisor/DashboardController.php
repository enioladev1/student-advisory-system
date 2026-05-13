<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('advisorProfile');

        $students            = $user->advisedStudents()->with('studentProfile')->get();
        $totalStudents       = $students->count();
        $pendingAppointments = $user->appointmentsAsAdvisor()->where('status', 'pending')->count();
        $unreadMessages      = $user->receivedMessages()->whereNull('read_at')->count();

        $recentAppointments = $user->appointmentsAsAdvisor()
            ->with('student')
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = $user->receivedMessages()
            ->with('sender')
            ->latest()
            ->take(5)
            ->get();

        return view('advisor.dashboard', compact(
            'user', 'students', 'totalStudents',
            'pendingAppointments', 'unreadMessages',
            'recentAppointments', 'recentMessages'
        ));
    }
}
