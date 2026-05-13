@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<div class="auth-card" style="max-width:520px;">
    <h3>Create Student Account</h3>
    <p class="auth-sub">Fill in your details to register</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. John Doe" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="student@school.com" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Matric Number</label>
                <input type="text" name="matric_number" value="{{ old('matric_number') }}" class="form-control @error('matric_number') is-invalid @enderror" placeholder="P/ND/23/3210111" required>
                @error('matric_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Department</label>
                <input type="text" name="department" value="{{ old('department') }}" class="form-control @error('department') is-invalid @enderror" placeholder="Computer Science" required>
                @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Faculty</label>
                <input type="text" name="faculty" value="{{ old('faculty') }}" class="form-control @error('faculty') is-invalid @enderror" placeholder="Science & Technology" required>
                @error('faculty')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Program</label>
                <select name="program" class="form-select @error('program') is-invalid @enderror" required>
                    <option value="">Select</option>
                    @foreach(['ND','HND','BSc','BA','BEng','BTech'] as $p)
                        <option value="{{ $p }}" {{ old('program')==$p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('program')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Level</label>
                <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                    <option value="">Select</option>
                    @foreach(['100','200','300','400'] as $l)
                        <option value="{{ $l }}" {{ old('level')==$l ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Session</label>
                <input type="text" name="session" value="{{ old('session', '2025/2026') }}" class="form-control @error('session') is-invalid @enderror" placeholder="2025/2026" required>
                @error('session')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone <span class="text-muted fw-normal">(optional)</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="08012345678">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min 8 characters" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
            </div>
            <div class="col-12 mt-1">
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <x-icon name="user" :size="16" /> Create Account
                </button>
            </div>
        </div>
    </form>
    <p class="auth-link text-center mt-4">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>
@endsection