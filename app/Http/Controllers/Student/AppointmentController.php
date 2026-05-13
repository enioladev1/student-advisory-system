<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()
            ->appointmentsAsStudent()
            ->with('advisor')
            ->latest()
            ->paginate(10);

        return view('student.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $advisors = Auth::user()->advisors()->with('advisorProfile')->get();
        return view('student.appointments.create', compact('advisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'advisor_id'       => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date', 'after:today'],
            'appointment_time' => ['required'],
            'purpose'          => ['required', 'string', 'max:255'],
            'notes'            => ['nullable', 'string', 'max:1000'],
        ]);

        Appointment::create([
            'student_id'       => Auth::id(),
            'advisor_id'       => $request->advisor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'purpose'          => $request->purpose,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return redirect()->route('student.appointments.index')
            ->with('success', 'Appointment request submitted successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->student_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($appointment->status, ['pending', 'approved'])) {
            return back()->with('error', 'This appointment cannot be cancelled.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled.');
    }
}
