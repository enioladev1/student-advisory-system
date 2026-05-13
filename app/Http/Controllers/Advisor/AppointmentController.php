<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()
            ->appointmentsAsAdvisor()
            ->with('student')
            ->latest()
            ->paginate(10);

        return view('advisor.appointments.index', compact('appointments'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->advisor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status'       => ['required', 'in:approved,rejected,completed'],
            'advisor_notes'=> ['nullable', 'string', 'max:1000'],
        ]);

        $appointment->update([
            'status'        => $request->status,
            'advisor_notes' => $request->advisor_notes,
        ]);

        return back()->with('success', 'Appointment updated.');
    }
}
