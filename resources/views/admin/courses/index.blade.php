@extends('layouts.app')
@section('title', 'Courses')
@section('page-title', 'Courses')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div><h1>Courses</h1><p>{{ $courses->total() }} courses in the system</p></div>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <x-icon name="plus" :size="16" /> Add Course
    </a>
</div>
<div class="card">
    @if($courses->isEmpty())
        <div class="card-body"><div class="empty-state"><x-icon name="book" :size="48" /><p class="mt-3">No courses yet</p></div></div>
    @else
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Code</th><th>Title</th><th>Units</th><th>Level</th><th>Semester</th><th>Department</th><th>Type</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td style="font-weight:700;color:#1a56db;">{{ $course->code }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->credit_units }}</td>
                    <td>{{ $course->level }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ $course->department }}</td>
                    <td>
                        <span class="status-badge {{ $course->is_compulsory ? 'status-completed' : 'status-cancelled' }}">
                            {{ $course->is_compulsory ? 'Compulsory' : 'Elective' }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                <x-icon name="trash" :size="13" />
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body pt-2">{{ $courses->links() }}</div>
    @endif
</div>
@endsection