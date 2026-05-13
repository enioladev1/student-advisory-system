@extends('layouts.app')
@section('title', 'My Courses')
@section('page-title', 'My Courses')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>My Courses</h1>
        <p>Your registered courses and academic performance</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card">
            <div class="stat-icon bg-blue-soft"><x-icon name="chart" :size="20" /></div>
            <div class="stat-value">{{ $cgpa }}</div>
            <div class="stat-label">Cumulative GPA (CGPA)</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card">
            <div class="stat-icon bg-green-soft"><x-icon name="check" :size="20" /></div>
            <div class="stat-value">{{ $earnedUnits }}</div>
            <div class="stat-label">Units Earned</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card">
            <div class="stat-icon bg-amber-soft"><x-icon name="book" :size="20" /></div>
            <div class="stat-value">{{ $totalUnits }}</div>
            <div class="stat-label">Total Registered Units</div>
        </div>
    </div>
</div>

@if($courses->isEmpty())
    <div class="card"><div class="card-body"><div class="empty-state">
        <x-icon name="book" :size="48" />
        <p class="mt-3 fw-600">No courses registered yet</p>
        <p>Your advisor or admin will register your courses for you.</p>
    </div></div></div>
@else
    @foreach($courses as $semester => $semCourses)
    <div class="card mb-3">
        <div class="card-header d-flex align-items-center gap-2">
            <x-icon name="book" :size="16" />
            {{ $semester }} Semester - {{ $semCourses->count() }} courses
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Units</th>
                        <th>Score</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semCourses as $sc)
                    <tr>
                        <td><span style="font-weight:600;color:#1a56db;">{{ $sc->course->code }}</span></td>
                        <td>{{ $sc->course->title }}</td>
                        <td>{{ $sc->course->credit_units }}</td>
                        <td>{{ $sc->score ?? '-' }}</td>
                        <td>
                            @if($sc->grade)
                                <span style="font-weight:700;font-size:14px;color:{{ $sc->grade==='F' ? '#dc2626' : ($sc->grade==='A' ? '#16a34a' : '#1e293b') }}">{{ $sc->grade }}</span>
                                <span style="font-size:11px;color:#64748b;">({{ $sc->grade_points }}pts)</span>
                            @else -
                            @endif
                        </td>
                        <td><span class="status-badge status-{{ $sc->status }}">{{ ucwords(str_replace('_',' ',$sc->status)) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
@endif
@endsection