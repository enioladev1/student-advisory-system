@extends('layouts.app')
@section('title', 'My Students')
@section('page-title', 'My Students')
@section('content')
<div class="page-header"><h1>My Students</h1><p>Students assigned to you for academic advisory</p></div>
<div class="card">
    @if($students->isEmpty())
        <div class="card-body"><div class="empty-state">
            <x-icon name="users" :size="48" />
            <p class="mt-3">No students have been assigned to you yet.</p>
        </div></div>
    @else
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>Student</th><th>Matric No.</th><th>Department</th><th>Program / Level</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1a56db;font-size:13px;flex-shrink:0;">
                                    {{ strtoupper(substr($student->name,0,1)) }}
                                </div>
                                <span style="font-weight:600;">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td style="color:#64748b;">{{ $student->studentProfile->matric_number ?? '-' }}</td>
                        <td>{{ $student->studentProfile->department ?? '-' }}</td>
                        <td>{{ $student->studentProfile ? $student->studentProfile->program.' L'.$student->studentProfile->level : '-' }}</td>
                        <td>
                            <a href="{{ route('advisor.students.show', $student) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                                <x-icon name="eye" :size="13" /> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection