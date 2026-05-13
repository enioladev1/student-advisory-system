@extends('layouts.app')
@section('title', 'Advisor Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="page-header">
    <h1>Welcome, {{ $user->name }}</h1>
    <p>@if($user->advisorProfile){{ $user->advisorProfile->department }} &middot; Staff ID: {{ $user->advisorProfile->staff_id }}@endif</p>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-blue-soft"><x-icon name="users" :size="20" /></div>
            <div class="stat-value">{{ $totalStudents }}</div>
            <div class="stat-label">Assigned Students</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-amber-soft"><x-icon name="calendar" :size="20" /></div>
            <div class="stat-value">{{ $pendingAppointments }}</div>
            <div class="stat-label">Pending Appointments</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-purple-soft"><x-icon name="mail" :size="20" /></div>
            <div class="stat-value">{{ $unreadMessages }}</div>
            <div class="stat-label">Unread Messages</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-teal-soft"><x-icon name="graduation" :size="20" /></div>
            <div class="stat-value">{{ $user->advisorProfile->max_students ?? '-' }}</div>
            <div class="stat-label">Student Capacity</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Recent Appointments</span>
                <a href="{{ route('advisor.appointments.index') }}" style="font-size:12px;color:#1a56db;text-decoration:none;">View all</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentAppointments as $appt)
                    <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                        <div style="width:36px;height:36px;border-radius:8px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;flex-shrink:0;">
                            {{ strtoupper(substr($appt->student->name,0,1)) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;color:#1e293b;">{{ $appt->student->name }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ $appt->purpose }} &middot; {{ $appt->appointment_date->format('d M Y') }}</div>
                        </div>
                        <span class="status-badge status-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span>
                    </div>
                @empty
                    <div class="empty-state"><p>No appointments yet</p></div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>My Students</span>
                <a href="{{ route('advisor.students.index') }}" style="font-size:12px;color:#1a56db;text-decoration:none;">View all</a>
            </div>
            <div class="card-body p-0">
                @forelse($students->take(6) as $student)
                    <a href="{{ route('advisor.students.show', $student) }}" class="d-flex align-items-center gap-3 px-4 py-3 text-decoration-none" style="border-bottom:1px solid #f1f5f9;color:inherit;transition:background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <div style="width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:13px;flex-shrink:0;">
                            {{ strtoupper(substr($student->name,0,1)) }}
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:600;color:#1e293b;">{{ $student->name }}</div>
                            @if($student->studentProfile)
                                <div style="font-size:11.5px;color:#64748b;">{{ $student->studentProfile->matric_number }}</div>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="empty-state"><p>No students assigned yet</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection