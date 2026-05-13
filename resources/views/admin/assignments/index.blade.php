@extends('layouts.app')
@section('title', 'Assignments')
@section('page-title', 'Advisor Assignments')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Advisor Assignments</h1>
        <p>Assign students to their academic advisors</p>
    </div>
</div>

@if($unassignedStudents->count() > 0)
<div class="alert alert-warning d-flex align-items-center gap-2 mb-4">
    <x-icon name="alert" :size="16" />
    <span><strong>{{ $unassignedStudents->count() }}</strong> student(s) have not been assigned an advisor yet.</span>
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2"><x-icon name="link" :size="16" /> Assign Student to Advisor</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.assignments.assign') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Advisor</label>
                        <select name="advisor_id" class="form-select @error('advisor_id') is-invalid @enderror" required>
                            <option value="">Choose advisor...</option>
                            @foreach($advisors as $advisor)
                                <option value="{{ $advisor->id }}">{{ $advisor->name }} ({{ $advisor->advisedStudents->count() }}/{{ $advisor->advisorProfile->max_students ?? '?' }})</option>
                            @endforeach
                        </select>
                        @error('advisor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Select Student</label>
                        <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                            <option value="">Choose student...</option>
                            @foreach($unassignedStudents as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} - {{ $s->studentProfile->matric_number ?? '' }}</option>
                            @endforeach
                        </select>
                        @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <x-icon name="link" :size="15" /> Assign
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        @foreach($advisors as $advisor)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center gap-2">
                <div style="width:30px;height:30px;border-radius:7px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:13px;flex-shrink:0;">{{ strtoupper(substr($advisor->name,0,1)) }}</div>
                <div style="flex:1;">
                    <span style="font-weight:600;">{{ $advisor->name }}</span>
                    <span style="font-size:12px;color:#64748b;margin-left:8px;">{{ $advisor->advisedStudents->count() }} student(s)</span>
                </div>
            </div>
            @if($advisor->advisedStudents->isEmpty())
                <div class="card-body"><p style="font-size:13px;color:#94a3b8;margin:0;">No students assigned</p></div>
            @else
            <div class="card-body p-0">
                @foreach($advisor->advisedStudents as $student)
                <div class="d-flex align-items-center gap-3 px-4 py-2" style="border-bottom:1px solid #f1f5f9;">
                    <div style="flex:1;font-size:13.5px;font-weight:500;">
                        {{ $student->name }}
                        @if($student->studentProfile)<span style="color:#64748b;font-weight:400;font-size:12px;"> - {{ $student->studentProfile->matric_number }}</span>@endif
                    </div>
                    <form method="POST" action="{{ route('admin.assignments.unassign') }}">
                        @csrf
                        <input type="hidden" name="advisor_id" value="{{ $advisor->id }}">
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1" onclick="return confirm('Remove this assignment?')">
                            <x-icon name="x" :size="12" /> Remove
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection