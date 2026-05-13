@extends('layouts.app')
@section('title', $student->name.' - Progress')
@section('page-title', 'Student Progress')
@section('content')
<div class="page-header d-flex align-items-center gap-3">
    <a href="{{ route('admin.users.index', ['role'=>'student']) }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
        <x-icon name="arrow-left" :size="14" /> Back
    </a>
    <div>
        <h1>{{ $student->name }}</h1>
        <p>{{ $student->studentProfile->matric_number ?? '' }} &middot; {{ $student->studentProfile->department ?? '' }}</p>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-blue-soft"><x-icon name="book" :size="18" /></div><div class="stat-value">{{ $student->courses->count() }}</div><div class="stat-label">Total Courses</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-green-soft"><x-icon name="check" :size="18" /></div><div class="stat-value">{{ $earnedUnits }}</div><div class="stat-label">Units Earned</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-amber-soft"><x-icon name="chart" :size="18" /></div><div class="stat-value">{{ $cgpa }}</div><div class="stat-label">CGPA</div></div>
    </div>
    <div class="col-sm-3">
        <div class="stat-card"><div class="stat-icon bg-red-soft"><x-icon name="alert" :size="18" /></div><div class="stat-value">{{ $student->courses->whereIn('status',['failed','carry_over'])->count() }}</div><div class="stat-label">Carry Overs</div></div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">Course Records</div>
            @if($student->courses->isEmpty())
                <div class="card-body"><div class="empty-state"><p>No records</p></div></div>
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
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">Record Score</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.students.update-score', $student) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-select" required>
                            <option value="">Select course...</option>
                            @foreach($availableCourses as $c)
                                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Session</label>
                            <input type="text" name="session" value="{{ $student->studentProfile->session ?? '2025/2026' }}" class="form-control" placeholder="2025/2026" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Semester</label>
                            <select name="semester" class="form-select" required>
                                <option value="First">First</option>
                                <option value="Second">Second</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Score (0–100)</label>
                        <input type="number" name="score" class="form-control @error('score') is-invalid @enderror" min="0" max="100" step="0.01" required>
                        @error('score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <x-icon name="check" :size="15" /> Save Score
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection