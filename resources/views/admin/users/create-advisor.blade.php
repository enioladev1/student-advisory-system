@extends('layouts.app')
@section('title', 'Add Advisor')
@section('page-title', 'Add Advisor')
@section('content')
<div class="page-header">
    <a href="{{ route('admin.users.index', ['role'=>'advisor']) }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center gap-1 mb-3">
        <x-icon name="arrow-left" :size="14" /> Back
    </a>
    <h1>Create Advisor Account</h1>
    <p>Register a new academic advisor in the system</p>
</div>
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store-advisor') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Staff ID</label>
                    <input type="text" name="staff_id" value="{{ old('staff_id') }}" class="form-control @error('staff_id') is-invalid @enderror" placeholder="e.g. STAFF/2024/001" required>
                    @error('staff_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" value="{{ old('department') }}" class="form-control @error('department') is-invalid @enderror" required>
                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Faculty</label>
                    <input type="text" name="faculty" value="{{ old('faculty') }}" class="form-control @error('faculty') is-invalid @enderror" required>
                    @error('faculty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Max Students</label>
                    <input type="number" name="max_students" value="{{ old('max_students', 30) }}" class="form-control @error('max_students') is-invalid @enderror" min="1" max="100" required>
                    @error('max_students')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Bio <span class="text-muted fw-normal">(optional)</span></label>
                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3">{{ old('bio') }}</textarea>
                    @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="col-12 mt-1">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <x-icon name="user" :size="16" /> Create Advisor
                    </button>
                    <a href="{{ route('admin.users.index', ['role'=>'advisor']) }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection