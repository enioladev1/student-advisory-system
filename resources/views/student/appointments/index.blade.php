@extends('layouts.app')
@section('title', 'Appointments')
@section('page-title', 'Appointments')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div><h1>My Appointments</h1><p>Manage your advisory sessions</p></div>
    <a href="{{ route('student.appointments.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <x-icon name="plus" :size="16" /> New Appointment
    </a>
</div>

<div class="card">
    @if($appointments->isEmpty())
        <div class="card-body"><div class="empty-state">
            <x-icon name="calendar" :size="48" />
            <p class="mt-3 fw-600">No appointments yet</p>
            <p>Book an appointment with your advisor to get started.</p>
            <a href="{{ route('student.appointments.create') }}" class="btn btn-primary btn-sm mt-2">Book Now</a>
        </div></div>
    @else
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr><th>Date & Time</th><th>Advisor</th><th>Purpose</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appt)
                    <tr>
                        <td>
                            <div style="font-weight:600;">{{ $appt->appointment_date->format('d M Y') }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ date('h:i A', strtotime($appt->appointment_time)) }}</div>
                        </td>
                        <td>{{ $appt->advisor->name }}</td>
                        <td>{{ $appt->purpose }}</td>
                        <td><span class="status-badge status-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span></td>
                        <td>
                            @if(in_array($appt->status, ['pending','approved']))
                                <form method="POST" action="{{ route('student.appointments.destroy', $appt) }}" onsubmit="return confirm('Cancel this appointment?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                        <x-icon name="x" :size="13" /> Cancel
                                    </button>
                                </form>
                            @else
                                <span style="color:#94a3b8;font-size:12px;">-</span>
                            @endif
                        </td>
                    </tr>
                    @if($appt->advisor_notes)
                    <tr style="background:#f8fafc;">
                        <td colspan="5" style="font-size:12.5px;color:#475569;padding:8px 14px;">
                            <strong>Advisor note:</strong> {{ $appt->advisor_notes }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body pt-2">{{ $appointments->links() }}</div>
    @endif
</div>
@endsection