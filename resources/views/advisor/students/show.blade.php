@extends('layouts.app')
@section('title', $student->name)
@section('page-title', 'Student Profile')
@section('content')
<div class="page-header d-flex align-items-center gap-3">
    <a href="{{ route('advisor.students.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
        <x-icon name="arrow-left" :size="14" /> Back
    </a>
    <div>
        <h1>{{ $student->name }}</h1>
        <p>{{ $student->studentProfile->matric_number ?? '' }} &middot; {{ $student->studentProfile->department ?? '' }}</p>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-blue-soft"><x-icon name="book" :size="18" /></div>
            <div class="stat-value">{{ $student->courses->count() }}</div><div class="stat-label">Total Courses</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-green-soft"><x-icon name="check" :size="18" /></div>
            <div class="stat-value">{{ $earnedUnits }}</div><div class="stat-label">Units Earned</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-amber-soft"><x-icon name="chart" :size="18" /></div>
            <div class="stat-value">{{ $cgpa }}</div><div class="stat-label">CGPA</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-red-soft"><x-icon name="alert" :size="18" /></div>
            <div class="stat-value">{{ $student->courses->whereIn('status',['failed','carry_over'])->count() }}</div>
            <div class="stat-label">Carry Overs</div></div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">Student Information</div>
            <div class="card-body">
                @if($student->studentProfile)
                <table style="width:100%;font-size:13.5px;">
                    @foreach(['matric_number'=>'Matric No.','department'=>'Department','faculty'=>'Faculty','program'=>'Program','level'=>'Level','session'=>'Session','phone'=>'Phone'] as $field => $label)
                    <tr><td style="color:#64748b;padding:6px 0;width:45%;">{{ $label }}</td><td style="font-weight:500;padding:6px 0;">{{ $student->studentProfile->$field ?? '-' }}</td></tr>
                    @endforeach
                </table>
                @endif
                <div class="mt-3">
                    <a href="{{ route('advisor.messages.index') }}" class="btn btn-outline-primary btn-sm w-100 d-flex align-items-center justify-content-center gap-1">
                        <x-icon name="message" :size="14" /> Send Message
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Course Records</div>
            @if($student->courses->isEmpty())
                <div class="card-body"><div class="empty-state"><p>No course records</p></div></div>
            @else
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Code</th><th>Title</th><th>Units</th><th>Score</th><th>Grade</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($student->courses as $sc)
                        <tr>
                            <td style="font-weight:600;color:#1a56db;">{{ $sc->course->code }}</td>
                            <td>{{ $sc->course->title }}</td>
                            <td>{{ $sc->course->credit_units }}</td>
                            <td>{{ $sc->score ?? '-' }}</td>
                            <td>@if($sc->grade)<span style="font-weight:700;color:{{ $sc->grade==='F'?'#dc2626':($sc->grade==='A'?'#16a34a':'#1e293b') }}">{{ $sc->grade }}</span>@else -@endif</td>
                            <td><span class="status-badge status-{{ $sc->status }}">{{ ucwords(str_replace('_',' ',$sc->status)) }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection