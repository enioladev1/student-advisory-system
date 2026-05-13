@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="page-header">
    <h1>Welcome back, {{ $user->name }}</h1>
    <p>
        @if($user->studentProfile)
            {{ $user->studentProfile->matric_number }} &middot; {{ $user->studentProfile->department }} &middot; {{ $user->studentProfile->program }} {{ $user->studentProfile->level }} Level
        @endif
    </p>
</div>

{{-- Stats row --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-blue-soft"><x-icon name="book" :size="20" /></div>
            <div class="stat-value">{{ $totalCourses }}</div>
            <div class="stat-label">Registered Courses</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-green-soft"><x-icon name="check" :size="20" /></div>
            <div class="stat-value">{{ $passedCourses }}</div>
            <div class="stat-label">Courses Passed</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-amber-soft"><x-icon name="chart" :size="20" /></div>
            <div class="stat-value">{{ $gpa }}</div>
            <div class="stat-label">Current CGPA</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-purple-soft"><x-icon name="calendar" :size="20" /></div>
            <div class="stat-value">{{ $pendingAppointments }}</div>
            <div class="stat-label">Pending Appointments</div>
        </div>
    </div>
</div>

{{-- Credit progress --}}
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Credit Units Progress</span>
                <span style="font-size:12px;font-weight:500;color:#64748b;">{{ $earnedUnits }} / {{ $totalUnits }} units</span>
            </div>
            <div class="card-body">
                @if($totalUnits > 0)
                    @php $pct = round(($earnedUnits / $totalUnits) * 100); @endphp
                    <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;color:#64748b;">
                        <span>{{ $pct }}% complete</span><span>{{ $totalUnits - $earnedUnits }} units remaining</span>
                    </div>
                    <div class="progress" style="height:8px;border-radius:4px;background:#e2e8f0;">
                        <div class="progress-bar" style="width:{{ $pct }}%;background:#1a56db;border-radius:4px;"></div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-4 text-center">
                            <div style="font-size:18px;font-weight:700;color:#1a56db;">{{ $earnedUnits }}</div>
                            <div style="font-size:11.5px;color:#64748b;">Earned</div>
                        </div>
                        <div class="col-4 text-center" style="border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;">
                            <div style="font-size:18px;font-weight:700;color:#16a34a;">{{ $passedCourses }}</div>
                            <div style="font-size:11.5px;color:#64748b;">Passed</div>
                        </div>
                        <div class="col-4 text-center">
                            <div style="font-size:18px;font-weight:700;color:#dc2626;">{{ $failedCourses }}</div>
                            <div style="font-size:11.5px;color:#64748b;">Failed/C.O.</div>
                        </div>
                    </div>
                @else
                    <div class="empty-state"><x-icon name="book" :size="36" /><p class="mt-2">No courses registered yet</p></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">My Advisor</div>
            <div class="card-body">
                @forelse($user->advisors as $advisor)
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width:40px;height:40px;border-radius:10px;background:#eff6ff;display:flex;align-items:center;justify-content:center;color:#1a56db;font-weight:700;font-size:16px;flex-shrink:0;">
                            {{ strtoupper(substr($advisor->name,0,1)) }}
                        </div>
                        <div>
                            <div style="font-size:13.5px;font-weight:600;color:#1e293b;">{{ $advisor->name }}</div>
                            @if($advisor->advisorProfile)
                                <div style="font-size:12px;color:#64748b;">{{ $advisor->advisorProfile->department }}</div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('student.appointments.create') }}" class="btn btn-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                        <x-icon name="calendar" :size="14" /> Book Appointment
                    </a>
                @empty
                    <div class="empty-state" style="padding:24px 0;">
                        <x-icon name="users" :size="32" />
                        <p class="mt-2">No advisor assigned yet.<br>Contact the admin office.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Recent activity --}}
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Recent Appointments</span>
                <a href="{{ route('student.appointments.index') }}" style="font-size:12px;color:#1a56db;text-decoration:none;">View all</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentAppointments as $appt)
                    <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                        <div style="width:36px;height:36px;border-radius:8px;background:#f8fafc;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <x-icon name="calendar" :size="16" style="color:#64748b;" />
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:600;color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $appt->purpose }}</div>
                            <div style="font-size:12px;color:#64748b;">{{ $appt->appointment_date->format('D, d M Y') }} &middot; {{ $appt->advisor->name }}</div>
                        </div>
                        <span class="status-badge status-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span>
                    </div>
                @empty
                    <div class="empty-state"><p>No appointments yet</p></div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>Recent Messages</span>
                <a href="{{ route('student.messages.index') }}" style="font-size:12px;color:#1a56db;text-decoration:none;">View all</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentMessages as $msg)
                    <div class="d-flex align-items-center gap-3 px-4 py-3 {{ !$msg->read_at ? 'bg-light' : '' }}" style="border-bottom:1px solid #f1f5f9;">
                        <div style="width:36px;height:36px;border-radius:8px;background:#f8fafc;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <x-icon name="mail" :size="16" style="color:#64748b;" />
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:{{ $msg->read_at ? '400' : '600' }};color:#1e293b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $msg->subject }}</div>
                            <div style="font-size:12px;color:#64748b;">From {{ $msg->sender->name }}</div>
                        </div>
                        @if(!$msg->read_at)<span style="width:7px;height:7px;background:#1a56db;border-radius:50%;flex-shrink:0;display:inline-block;"></span>@endif
                    </div>
                @empty
                    <div class="empty-state"><p>No messages yet</p></div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection