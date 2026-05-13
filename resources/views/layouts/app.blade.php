<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academic Advisory') - SAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/3/3.1.1/iconify.min.js" defer></script>
    <style>
        :root {
            --sidebar-width: 260px; --topbar-height: 64px; --primary: #1a56db;
            --primary-dark: #1346b8; --sidebar-bg: #0f1729; --sidebar-text: #94a3b8;
            --body-bg: #f4f6fb; --card-border: #e2e8f0; --muted: #64748b;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; background: var(--body-bg); color: #1e293b; margin: 0; }
        .sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-width); background: var(--sidebar-bg); display: flex; flex-direction: column; z-index: 1000; overflow-y: auto; transition: transform 0.3s ease; }
        .sidebar-logo { padding: 22px 20px 18px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .logo-icon { width: 36px; height: 36px; background: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
        .app-name { font-size: 13px; font-weight: 700; color: #fff; }
        .app-tag  { font-size: 11px; color: var(--sidebar-text); margin-top: 2px; }
        .sidebar-section { font-size: 10px; font-weight: 700; color: #4a5568; letter-spacing: 1px; text-transform: uppercase; padding: 18px 20px 6px; }
        .sidebar-nav { padding: 8px 12px; flex: 1; }
        .sidebar-nav .nav-item { margin-bottom: 1px; }
        .sidebar-nav .nav-link { display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; color: var(--sidebar-text); font-size: 13.5px; font-weight: 500; text-decoration: none; transition: all 0.15s; }
        .sidebar-nav .nav-link:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .sidebar-nav .nav-link.active { background: var(--primary); color: #fff; }
        .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
        .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; text-decoration: none; transition: background 0.15s; }
        .sidebar-user:hover { background: rgba(255,255,255,0.07); }
        .su-avatar { width: 32px; height: 32px; border-radius: 8px; background: var(--primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 13px; flex-shrink: 0; }
        .su-name { font-size: 13px; font-weight: 600; color: #fff; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .su-role { font-size: 11px; color: var(--sidebar-text); text-transform: capitalize; }
        .logout-btn { display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; width: 100%; background: none; border: none; cursor: pointer; color: var(--sidebar-text); font-size: 13.5px; font-weight: 500; font-family: inherit; margin-top: 4px; transition: all 0.15s; }
        .logout-btn:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .main-wrap { margin-left: var(--sidebar-width); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { height: var(--topbar-height); background: #fff; border-bottom: 1px solid var(--card-border); display: flex; align-items: center; padding: 0 28px; gap: 12px; position: sticky; top: 0; z-index: 900; }
        .topbar-title { font-size: 15.5px; font-weight: 600; color: #1e293b; flex: 1; }
        .topbar-btn { width: 36px; height: 36px; border-radius: 8px; border: 1px solid var(--card-border); background: transparent; display: flex; align-items: center; justify-content: center; color: var(--muted); cursor: pointer; text-decoration: none; transition: all 0.15s; position: relative; }
        .topbar-btn:hover { background: var(--body-bg); color: #1e293b; }
        .badge-dot { position: absolute; top: 5px; right: 5px; width: 7px; height: 7px; background: #ef4444; border-radius: 50%; border: 1.5px solid #fff; }
        .page-content { padding: 28px; flex: 1; }
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0; }
        .page-header p { margin: 4px 0 0; font-size: 13.5px; color: var(--muted); }
        .card { border: 1px solid var(--card-border); border-radius: 12px; background: #fff; box-shadow: none; }
        .card-header { background: transparent; border-bottom: 1px solid var(--card-border); padding: 16px 20px; font-size: 14px; font-weight: 600; }
        .card-body { padding: 20px; }
        .stat-card { background: #fff; border: 1px solid var(--card-border); border-radius: 12px; padding: 20px; }
        .stat-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
        .stat-value { font-size: 28px; font-weight: 700; color: #1e293b; line-height: 1; }
        .stat-label { font-size: 12.5px; color: var(--muted); font-weight: 500; margin-top: 4px; }
        .bg-blue-soft   { background: #eff6ff !important; color: #1a56db !important; }
        .bg-green-soft  { background: #f0fdf4 !important; color: #16a34a !important; }
        .bg-amber-soft  { background: #fffbeb !important; color: #d97706 !important; }
        .bg-red-soft    { background: #fef2f2 !important; color: #dc2626 !important; }
        .bg-purple-soft { background: #faf5ff !important; color: #9333ea !important; }
        .bg-teal-soft   { background: #f0fdfa !important; color: #0d9488 !important; }
        .alert { border-radius: 10px; font-size: 13.5px; border: none; }
        .alert-success { background: #f0fdf4; color: #166534; }
        .alert-danger  { background: #fef2f2; color: #991b1b; }
        .alert-info    { background: #eff6ff; color: #1e40af; }
        .alert-warning { background: #fffbeb; color: #92400e; }
        .badge { font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 6px; }
        .status-badge { display: inline-block; padding: 3px 9px; border-radius: 6px; font-size: 11.5px; font-weight: 600; }
        .status-pending   { background: #fffbeb; color: #b45309; }
        .status-approved  { background: #f0fdf4; color: #166534; }
        .status-rejected  { background: #fef2f2; color: #991b1b; }
        .status-completed { background: #eff6ff; color: #1e40af; }
        .status-cancelled { background: #f1f5f9; color: #475569; }
        .status-registered{ background: #f0fdfa; color: #0d9488; }
        .status-passed    { background: #f0fdf4; color: #166534; }
        .status-failed    { background: #fef2f2; color: #991b1b; }
        .status-carry_over{ background: #fffbeb; color: #b45309; }
        .table { font-size: 13.5px; }
        .table thead th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted); background: #f8fafc; border-bottom: 1px solid var(--card-border); padding: 10px 14px; }
        .table td { padding: 12px 14px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .table tbody tr:last-child td { border-bottom: none; }
        .table-hover tbody tr:hover { background: #f8fafc; }
        .btn { font-size: 13.5px; font-weight: 500; border-radius: 8px; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-sm { padding: 5px 12px; font-size: 12.5px; }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); color: #fff; }
        .form-control, .form-select { border-radius: 8px; border-color: #e2e8f0; font-size: 13.5px; padding: 9px 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .invalid-feedback { font-size: 12px; }
        .empty-state { text-align: center; padding: 48px 20px; color: var(--muted); }
        .empty-state p { font-size: 13.5px; margin: 0; }
        .sidebar-toggle { display: none; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 999; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .page-content { padding: 16px; }
            .sidebar-toggle { display: flex; }
            .sidebar-overlay.open { display: block; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon"><x-icon name="graduation" :size="18" /></div>
        <div class="app-name">Student Advisory</div>
        <div class="app-tag">Academic Management System</div>
    </div>
    <nav class="sidebar-nav">
        @auth
            @if(auth()->user()->isAdmin())
                <div class="sidebar-section">Main</div>
                <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="iconify" data-icon="hugeicons:home-01" data-width="17" data-height="17"></span> Dashboard</a></div>
                <div class="sidebar-section">Management</div>
                <div class="nav-item"><a href="{{ route('admin.users.index', ['role'=>'student']) }}" class="nav-link {{ request()->routeIs('admin.users.*') && request()->get('role','student') === 'student' ? 'active' : '' }}"><x-icon name="graduation" :size="17" /> Students</a></div>
                <div class="nav-item"><a href="{{ route('admin.users.index', ['role'=>'advisor']) }}" class="nav-link {{ request()->routeIs('admin.users.*') && request()->get('role') === 'advisor' ? 'active' : '' }}"><x-icon name="briefcase" :size="17" /> Advisors</a></div>
                <div class="nav-item"><a href="{{ route('admin.assignments.index') }}" class="nav-link {{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}"><x-icon name="link" :size="17" /> Assignments</a></div>
                <div class="nav-item"><a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}"><x-icon name="book" :size="17" /> Courses</a></div>
            @elseif(auth()->user()->isAdvisor())
                <div class="sidebar-section">Main</div>
                <div class="nav-item"><a href="{{ route('advisor.dashboard') }}" class="nav-link {{ request()->routeIs('advisor.dashboard') ? 'active' : '' }}"><span class="iconify" data-icon="hugeicons:home-01" data-width="17" data-height="17"></span> Dashboard</a></div>
                <div class="sidebar-section">Advisory</div>
                <div class="nav-item"><a href="{{ route('advisor.students.index') }}" class="nav-link {{ request()->routeIs('advisor.students.*') ? 'active' : '' }}"><x-icon name="users" :size="17" /> My Students</a></div>
                <div class="nav-item">
                    <a href="{{ route('advisor.appointments.index') }}" class="nav-link {{ request()->routeIs('advisor.appointments.*') ? 'active' : '' }}">
                        <x-icon name="calendar" :size="17" /> Appointments
                        @php $pa = auth()->user()->appointmentsAsAdvisor()->where('status','pending')->count(); @endphp
                        @if($pa > 0)<span class="badge bg-primary ms-auto" style="font-size:10px;padding:3px 7px;">{{ $pa }}</span>@endif
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('advisor.messages.index') }}" class="nav-link {{ request()->routeIs('advisor.messages.*') ? 'active' : '' }}">
                        <x-icon name="message" :size="17" /> Messages
                        @php $um = auth()->user()->receivedMessages()->whereNull('read_at')->count(); @endphp
                        @if($um > 0)<span class="badge bg-primary ms-auto" style="font-size:10px;padding:3px 7px;">{{ $um }}</span>@endif
                    </a>
                </div>
            @else
                <div class="sidebar-section">Main</div>
                <div class="nav-item"><a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"><span class="iconify" data-icon="hugeicons:home-01" data-width="17" data-height="17"></span> Dashboard</a></div>
                <div class="sidebar-section">Academic</div>
                <div class="nav-item"><a href="{{ route('student.courses.index') }}" class="nav-link {{ request()->routeIs('student.courses.*') ? 'active' : '' }}"><x-icon name="book" :size="17" /> My Courses</a></div>
                <div class="nav-item"><a href="{{ route('student.appointments.index') }}" class="nav-link {{ request()->routeIs('student.appointments.*') ? 'active' : '' }}"><x-icon name="calendar" :size="17" /> Appointments</a></div>
                <div class="nav-item">
                    <a href="{{ route('student.messages.index') }}" class="nav-link {{ request()->routeIs('student.messages.*') ? 'active' : '' }}">
                        <x-icon name="message" :size="17" /> Messages
                        @php $um = auth()->user()->receivedMessages()->whereNull('read_at')->count(); @endphp
                        @if($um > 0)<span class="badge bg-primary ms-auto" style="font-size:10px;padding:3px 7px;">{{ $um }}</span>@endif
                    </a>
                </div>
            @endif
        @endauth
    </nav>
    <div class="sidebar-footer">
        @auth
        @php $profileRoute = auth()->user()->isAdmin() ? route('admin.profile') : (auth()->user()->isAdvisor() ? route('advisor.profile') : route('student.profile')); @endphp
        <a href="{{ $profileRoute }}" class="sidebar-user">
            <div class="su-avatar" style="background:none;padding:0;overflow:hidden">
                <img src="{{ asset('profile/' . auth()->user()->role . '.jpg') }}" alt="" style="width:100%;height:100%;object-fit:cover">
            </div>
            <div style="min-width:0;">
                <div class="su-name">{{ auth()->user()->name }}</div>
                <div class="su-role">{{ auth()->user()->role }}</div>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn"><x-icon name="logout" :size="17" /> Sign Out</button>
        </form>
        @endauth
    </div>
</aside>

<div class="main-wrap">
    <header class="topbar">
        <button class="topbar-btn sidebar-toggle border-0" onclick="toggleSidebar()"><x-icon name="menu" :size="18" /></button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="d-flex align-items-center gap-2">
            @auth
                @php $ucnt = auth()->user()->receivedMessages()->whereNull('read_at')->count(); @endphp
                @if(auth()->user()->isAdvisor())
                    <a href="{{ route('advisor.messages.index') }}" class="topbar-btn"><x-icon name="mail" :size="18" />@if($ucnt > 0)<span class="badge-dot"></span>@endif</a>
                @elseif(auth()->user()->isStudent())
                    <a href="{{ route('student.messages.index') }}" class="topbar-btn"><x-icon name="mail" :size="18" />@if($ucnt > 0)<span class="badge-dot"></span>@endif</a>
                @endif
                <a href="{{ $profileRoute }}" class="topbar-btn"><x-icon name="user" :size="18" /></a>
            @endauth
        </div>
    </header>
    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4"><x-icon name="check" :size="16" /> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-4"><x-icon name="alert" :size="16" /> {{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('sidebarOverlay').classList.toggle('open');}
function closeSidebar(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sidebarOverlay').classList.remove('open');}
</script>
@stack('scripts')
</body>
</html>