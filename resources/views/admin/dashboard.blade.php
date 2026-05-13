@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')
@section('content')
<div class="page-header"><h1>System Overview</h1><p>Academic Advisory System - Administration Panel</p></div>
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-blue-soft"><x-icon name="graduation" :size="20" /></div>
            <div class="stat-value">{{ $totalStudents }}</div>
            <div class="stat-label">Registered Students</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-teal-soft"><x-icon name="briefcase" :size="20" /></div>
            <div class="stat-value">{{ $totalAdvisors }}</div>
            <div class="stat-label">Academic Advisors</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-green-soft"><x-icon name="book" :size="20" /></div>
            <div class="stat-value">{{ $totalCourses }}</div>
            <div class="stat-label">Courses in System</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-amber-soft"><x-icon name="calendar" :size="20" /></div>
            <div class="stat-value">{{ $pendingAppts }}</div>
            <div class="stat-label">Pending Appointments</div>
        </div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Recent Students</span>
                <a href="{{ route('admin.users.index', ['role'=>'student']) }}" style="font-size:12px;color:#1a56db;text-decoration:none;">View all</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentStudents as $student)
                    <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                        <div style="width:34px;height:34px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:13px;flex-shrink:0;">
                            {{ strtoupper(substr($student->name,0,1)) }}
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:13px;font-weight:600;">{{ $student->name }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ $student->studentProfile->matric_number ?? '' }} &middot; {{ $student->studentProfile->department ?? '' }}</div>
                        </div>
                        <span style="font-size:11px;color:#94a3b8;">{{ $student->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="empty-state"><p>No students yet</p></div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Recent Appointments</div>
            <div class="card-body p-0">
                @forelse($recentAppointments as $appt)
                    <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;">{{ $appt->student->name }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ $appt->purpose }} &middot; {{ $appt->advisor->name }}</div>
                        </div>
                        <span class="status-badge status-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span>
                    </div>
                @empty
                    <div class="empty-state"><p>No appointments</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection