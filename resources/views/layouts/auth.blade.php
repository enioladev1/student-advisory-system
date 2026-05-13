<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - Student Advisory System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f6fb; min-height: 100vh; display: flex; }
        .auth-left {
            width: 420px; flex-shrink: 0; background: #0f1729;
            display: flex; flex-direction: column; justify-content: center; padding: 48px 40px;
        }
        .auth-left .logo-wrap { margin-bottom: 40px; }
        .auth-left .logo-icon { width: 44px; height: 44px; background: #1a56db; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
        .auth-left h2 { font-size: 22px; font-weight: 700; color: #fff; margin: 0 0 8px; }
        .auth-left p { font-size: 13.5px; color: #94a3b8; margin: 0; line-height: 1.6; }
        .auth-feature { display: flex; align-items: flex-start; gap: 12px; margin-top: 28px; }
        .auth-feature .feat-icon { width: 32px; height: 32px; background: rgba(26,86,219,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #60a5fa; }
        .auth-feature .feat-text h4 { font-size: 13px; font-weight: 600; color: #e2e8f0; margin: 0 0 2px; }
        .auth-feature .feat-text p { font-size: 12px; color: #64748b; margin: 0; }
        .auth-right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .auth-card { background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 36px 40px; width: 100%; max-width: 440px; }
        .auth-card h3 { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 6px; }
        .auth-card .auth-sub { font-size: 13.5px; color: #64748b; margin: 0 0 28px; }
        .form-control, .form-select { border-radius: 8px; border-color: #e2e8f0; font-size: 13.5px; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: #1a56db; box-shadow: 0 0 0 3px rgba(26,86,219,0.1); }
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .btn-primary { background: #1a56db; border-color: #1a56db; font-weight: 600; padding: 10px; border-radius: 8px; font-size: 14px; }
        .btn-primary:hover { background: #1346b8; border-color: #1346b8; }
        .invalid-feedback { font-size: 12px; }
        .auth-link { font-size: 13px; color: #64748b; }
        .auth-link a { color: #1a56db; text-decoration: none; font-weight: 500; }
        .auth-link a:hover { text-decoration: underline; }
        @media (max-width: 768px) { .auth-left { display: none; } .auth-right { padding: 24px 16px; } .auth-card { padding: 28px 24px; } }
    </style>
</head>
<body>
<div class="auth-left">
    <div class="logo-wrap">
        <div class="logo-icon">
            <x-icon name="graduation" :size="22" />
        </div>
        <h2>Student Advisory System</h2>
        <p>A comprehensive digital platform for academic guidance and student success.</p>
    </div>
    <div class="auth-feature">
        <div class="feat-icon"><x-icon name="chart" :size="16" /></div>
        <div class="feat-text"><h4>Track Academic Progress</h4><p>Monitor grades, units, and CGPA in real time</p></div>
    </div>
    <div class="auth-feature">
        <div class="feat-icon"><x-icon name="calendar" :size="16" /></div>
        <div class="feat-text"><h4>Book Appointments</h4><p>Schedule sessions with your assigned advisor</p></div>
    </div>
    <div class="auth-feature">
        <div class="feat-icon"><x-icon name="message" :size="16" /></div>
        <div class="feat-text"><h4>Direct Messaging</h4><p>Communicate with advisors from anywhere</p></div>
    </div>
</div>
<div class="auth-right">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>