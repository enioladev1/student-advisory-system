@extends('layouts.app')
@section('title', ucfirst($role).'s')
@section('page-title', ucfirst($role).'s')
@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>{{ ucfirst($role) }}s</h1>
        <p>{{ $users->total() }} {{ $role }}(s) in the system</p>
    </div>
    @if($role === 'advisor')
        <a href="{{ route('admin.users.create-advisor') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <x-icon name="plus" :size="16" /> Add Advisor
        </a>
    @endif
</div>
<div class="mb-3 d-flex gap-2">
    <a href="{{ route('admin.users.index', ['role'=>'student']) }}" class="btn btn-sm {{ $role==='student'?'btn-primary':'btn-outline-secondary' }}">Students</a>
    <a href="{{ route('admin.users.index', ['role'=>'advisor']) }}" class="btn btn-sm {{ $role==='advisor'?'btn-primary':'btn-outline-secondary' }}">Advisors</a>
    <a href="{{ route('admin.users.index', ['role'=>'admin']) }}" class="btn btn-sm {{ $role==='admin'?'btn-primary':'btn-outline-secondary' }}">Admins</a>
</div>
<div class="card">
    @if($users->isEmpty())
        <div class="card-body"><div class="empty-state"><p>No {{ $role }}s found</p></div></div>
    @else
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    @if($role === 'student')<th>Matric No.</th><th>Department</th><th>Level</th>
                    @elseif($role === 'advisor')<th>Staff ID</th><th>Department</th><th>Students</th>
                    @endif
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>
                        <div style="font-weight:600;">{{ $u->name }}</div>
                        <div style="font-size:12px;color:#64748b;">{{ $u->email }}</div>
                    </td>
                    @if($role === 'student')
                        <td>{{ $u->studentProfile->matric_number ?? '-' }}</td>
                        <td>{{ $u->studentProfile->department ?? '-' }}</td>
                        <td>{{ $u->studentProfile ? $u->studentProfile->program.' L'.$u->studentProfile->level : '-' }}</td>
                    @elseif($role === 'advisor')
                        <td>{{ $u->advisorProfile->staff_id ?? '-' }}</td>
                        <td>{{ $u->advisorProfile->department ?? '-' }}</td>
                        <td>{{ $u->advisedStudents->count() }} / {{ $u->advisorProfile->max_students ?? '-' }}</td>
                    @endif
                    <td>
                        <span class="status-badge {{ $u->is_active ? 'status-approved' : 'status-rejected' }}">
                            {{ $u->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            @if($role === 'student')
                                <a href="{{ route('admin.students.progress', $u) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <x-icon name="chart" :size="13" /> Progress
                                </a>
                            @endif
                            <form method="POST" action="{{ route('admin.users.toggle-status', $u) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                    {{ $u->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Delete this user? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                    <x-icon name="trash" :size="13" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body pt-2">{{ $users->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection