@extends('layouts.auth')
@section('title', 'Sign In')
@section('content')
<div class="auth-card">
    <h3>Welcome back</h3>
    <p class="auth-sub">Sign in to your account to continue</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" required autofocus>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:13px;">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
            <x-icon name="arrow-right" :size="16" /> Sign In
        </button>
    </form>
    <p class="auth-link text-center mt-4">Don't have an account? <a href="{{ route('register') }}">Register as Student</a></p>
</div>
@endsection