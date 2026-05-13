@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="page-header">
    <h1>My Profile</h1>
    <p>Manage your account information and password</p>
</div>

@php $user = auth()->user(); @endphp

{{-- ── Account Info ── --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <span class="iconify" data-icon="hugeicons:user-circle" data-width="17" data-height="17" style="color:var(--primary)"></span>
        Account Information
    </div>
    <div class="card-body">

        {{-- Avatar + name --}}
        <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom:1px solid var(--card-border)">
            <div style="width:64px;height:64px;border-radius:12px;overflow:hidden;flex-shrink:0;border:1px solid var(--card-border)">
                <img src="{{ asset('profile/' . $user->role . '.jpg') }}" alt="{{ $user->role }} avatar" style="width:100%;height:100%;object-fit:cover">
            </div>
            <div>
                <div style="font-weight:700;font-size:1rem;color:#1e293b">{{ $user->name }}</div>
                <div style="font-size:0.8rem;color:var(--muted);margin-top:2px">{{ $user->email }}</div>
                <span class="status-badge mt-1" style="background:#eff6ff;color:var(--primary);text-transform:capitalize">
                    {{ $user->role }}
                </span>
            </div>
        </div>

        {{-- Info grid --}}
        <div class="row g-4">
            <div class="col-6 col-md-4 col-lg-2">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Full Name</div>
                <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->name }}</div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Email Address</div>
                <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->email }}</div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Role</div>
                <div style="font-size:0.9rem;color:#1e293b;font-weight:500;text-transform:capitalize">{{ $user->role }}</div>
            </div>

            @if($user->isStudent() && $user->studentProfile)
                <div class="col-6 col-md-4 col-lg-2">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Matric Number</div>
                    <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->studentProfile->matric_number }}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Department</div>
                    <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->studentProfile->department }}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Programme / Level</div>
                    <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->studentProfile->program }} - Level {{ $user->studentProfile->level }}</div>
                </div>
            @elseif($user->isAdvisor() && $user->advisorProfile)
                <div class="col-6 col-md-4 col-lg-2">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Staff ID</div>
                    <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->advisorProfile->staff_id }}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem">Department</div>
                    <div style="font-size:0.9rem;color:#1e293b;font-weight:500">{{ $user->advisorProfile->department }}</div>
                </div>
            @endif
        </div>

    </div>
</div>

{{-- ── Change Password + Security Tips ── --}}
<div class="row g-4">

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <span class="iconify" data-icon="hugeicons:lock-password" data-width="17" data-height="17" style="color:var(--primary)"></span>
                Change Password
            </div>
            <div class="card-body">

                @if(session('status') === 'password-updated')
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                        <span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="16" data-height="16"></span>
                        Password updated successfully.
                    </div>
                @endif

                <p style="font-size:0.875rem;color:var(--muted);margin-bottom:1.5rem;line-height:1.6">
                    Choose a strong password you haven't used before. Your password must be at least 8 characters long.
                </p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label" for="current_password">Current Password</label>
                        <div style="position:relative">
                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                placeholder="Enter your current password"
                                autocomplete="current-password"
                            >
                            <button type="button" onclick="togglePw('current_password', this)"
                                style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);padding:0;display:flex;align-items:center">
                                <span class="iconify" data-icon="hugeicons:view" data-width="17" data-height="17"></span>
                            </button>
                        </div>
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password">New Password</label>
                        <div style="position:relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                placeholder="Enter new password"
                                autocomplete="new-password"
                            >
                            <button type="button" onclick="togglePw('password', this)"
                                style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);padding:0;display:flex;align-items:center">
                                <span class="iconify" data-icon="hugeicons:view" data-width="17" data-height="17"></span>
                            </button>
                        </div>
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password_confirmation">Confirm New Password</label>
                        <div style="position:relative">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                placeholder="Confirm new password"
                                autocomplete="new-password"
                            >
                            <button type="button" onclick="togglePw('password_confirmation', this)"
                                style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);padding:0;display:flex;align-items:center">
                                <span class="iconify" data-icon="hugeicons:view" data-width="17" data-height="17"></span>
                            </button>
                        </div>
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password strength indicator --}}
                    <div class="mb-4" id="strength-wrap" style="display:none">
                        <div style="font-size:0.72rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem">
                            Password strength: <span id="strength-label" style="color:#1e293b">-</span>
                        </div>
                        <div style="height:4px;background:#e2e8f0;border-radius:2px">
                            <div id="strength-bar" style="height:100%;width:0%;border-radius:2px;transition:width 0.3s,background 0.3s"></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 pt-2" style="border-top:1px solid var(--card-border)">
                        <button type="submit" class="btn btn-primary px-4">
                            <span class="iconify me-1" data-icon="hugeicons:lock-password" data-width="15" data-height="15"></span>
                            Update Password
                        </button>
                        <a href="{{ $user->isAdmin() ? route('admin.dashboard') : ($user->isAdvisor() ? route('advisor.dashboard') : route('student.dashboard')) }}"
                           class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- ── Security Tips ── --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <span class="iconify" data-icon="hugeicons:shield-01" data-width="17" data-height="17" style="color:var(--primary)"></span>
                Security Tips
            </div>
            <div class="card-body p-0">
                @foreach([
                    ['hugeicons:checkmark-circle-01', 'Use at least 8 characters including numbers and symbols'],
                    ['hugeicons:checkmark-circle-01', 'Never share your password with anyone'],
                    ['hugeicons:checkmark-circle-01', 'Avoid using personal information like your name or matric number'],
                    ['hugeicons:checkmark-circle-01', 'Change your password regularly for better security'],
                ] as [$icon, $tip])
                <div class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid var(--card-border)">
                    <span class="iconify flex-shrink-0" data-icon="{{ $icon }}" data-width="15" data-height="15" style="color:#16a34a"></span>
                    <span style="font-size:0.84rem;color:var(--muted)">{{ $tip }}</span>
                </div>
                @endforeach
                <style>.card-body .d-flex:last-child{border-bottom:none!important}</style>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.querySelector('.iconify').setAttribute('data-icon', isHidden ? 'hugeicons:view-off' : 'hugeicons:view');
}

const pwInput = document.getElementById('password');
const strengthBar = document.getElementById('strength-bar');
const strengthLabel = document.getElementById('strength-label');
const strengthWrap = document.getElementById('strength-wrap');

pwInput.addEventListener('input', function () {
    const val = this.value;
    if (!val) { strengthWrap.style.display = 'none'; return; }
    strengthWrap.style.display = 'block';

    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { label: 'Very Weak',   color: '#ef4444', width: '20%' },
        { label: 'Weak',        color: '#f97316', width: '40%' },
        { label: 'Fair',        color: '#eab308', width: '60%' },
        { label: 'Strong',      color: '#22c55e', width: '80%' },
        { label: 'Very Strong', color: '#16a34a', width: '100%' },
    ];
    const level = levels[Math.min(score, 4)];
    strengthBar.style.width      = level.width;
    strengthBar.style.background = level.color;
    strengthLabel.textContent    = level.label;
    strengthLabel.style.color    = level.color;
});
</script>
@endpush
