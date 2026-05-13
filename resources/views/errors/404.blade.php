<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | SAS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/3/3.1.1/iconify.min.js" defer></script>

    <style>
        :root {
            --navy:    #0f1729;
            --blue:    #1a56db;
            --blue-lt: #60a5fa;
            --blue-dk: #1346b8;
            --body-bg: #f4f6fb;
            --text:    #1e293b;
            --muted:   #64748b;
            --border:  #e2e8f0;
            --white:   #ffffff;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--body-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAV ── */
        .e-nav {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0;
        }

        .e-nav__inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .e-nav__brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: var(--text);
        }

        .e-nav__logo {
            width: 36px;
            height: 36px;
            background: var(--blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            flex-shrink: 0;
        }

        .e-nav__wordmark {
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text);
        }

        .e-nav__wordmark em {
            font-style: normal;
            color: var(--blue);
        }

        /* ── MAIN ── */
        .e-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
        }

        .e-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 3.5rem 3rem;
            max-width: 540px;
            width: 100%;
            text-align: center;
        }

        /* ── 404 GRAPHIC ── */
        .e-graphic {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .e-graphic__ring {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #eff6ff;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .e-graphic__icon {
            color: var(--blue);
            animation: wobble 3s ease-in-out infinite;
        }

        .e-graphic__badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 36px;
            height: 36px;
            background: var(--navy);
            border-radius: 50%;
            border: 3px solid var(--body-bg);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .e-graphic__badge-text {
            font-size: 0.6rem;
            font-weight: 800;
            color: var(--blue-lt);
            letter-spacing: 0.05em;
        }

        /* ── NUMBER ── */
        .e-code {
            font-size: 6rem;
            font-weight: 900;
            color: var(--navy);
            line-height: 1;
            letter-spacing: -0.04em;
            margin-bottom: 0.25rem;
        }

        .e-code span {
            color: var(--blue);
        }

        /* ── TEXT ── */
        .e-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.65rem;
        }

        .e-body {
            font-size: 0.92rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 380px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ── ACTIONS ── */
        .e-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .e-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
            white-space: nowrap;
        }

        .e-btn--primary {
            background: var(--blue);
            color: var(--white);
            border: 1.5px solid var(--blue);
            padding: 0.65rem 1.5rem;
        }

        .e-btn--primary:hover {
            background: var(--blue-dk);
            border-color: var(--blue-dk);
            color: var(--white);
        }

        .e-btn--ghost {
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border);
            padding: 0.65rem 1.5rem;
        }

        .e-btn--ghost:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        /* ── DIVIDER ── */
        .e-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .e-divider::before,
        .e-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .e-divider span {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── QUICK LINKS ── */
        .e-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
        }


        .e-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.7rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            font-size: 0.84rem;
            font-weight: 500;
            transition: border-color 0.15s, background 0.15s;
            text-align: left;
        }

        .e-link:hover {
            border-color: var(--blue);
            background: #eff6ff;
            color: var(--blue);
        }

        .e-link__icon {
            width: 30px;
            height: 30px;
            background: var(--body-bg);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .e-link:hover .e-link__icon {
            background: #dbeafe;
        }

        /* ── FOOTER ── */
        .e-footer {
            text-align: center;
            padding: 1.25rem 2rem;
            font-size: 0.75rem;
            color: var(--muted);
            border-top: 1px solid var(--border);
        }

        /* ── ANIMATION ── */
        @keyframes wobble {
            0%, 100% { transform: rotate(0deg); }
            20%       { transform: rotate(-8deg); }
            40%       { transform: rotate(8deg); }
            60%       { transform: rotate(-4deg); }
            80%       { transform: rotate(4deg); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .e-card { animation: fadeUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }

        /* ── RESPONSIVE ── */
        @media (max-width: 480px) {
            .e-card { padding: 2.5rem 1.5rem; border-radius: 12px; }
            .e-code  { font-size: 4.5rem; }
            .e-nav__inner { padding: 0.9rem 1.25rem; }
            .e-btn { padding: 0.65rem 1rem; font-size: 0.82rem; }
        }
    </style>
</head>
<body>

<nav class="e-nav">
    <div class="e-nav__inner">
        <a href="{{ url('/') }}" class="e-nav__brand">
            <div class="e-nav__logo">
                <span class="iconify" data-icon="hugeicons:mortarboard-01" data-width="18" data-height="18"></span>
            </div>
            <span class="e-nav__wordmark">S<em>A</em>S</span>
        </a>
    </div>
</nav>

<main class="e-main">
    <div class="e-card">

        <div class="e-graphic">
            <div class="e-graphic__ring">
                <span class="e-graphic__icon iconify" data-icon="hugeicons:search-02" data-width="48" data-height="48"></span>
            </div>
            <div class="e-graphic__badge">
                <span class="e-graphic__badge-text">404</span>
            </div>
        </div>

        <div class="e-code">4<span>0</span>4</div>

        <h1 class="e-title">Page not found</h1>

        <p class="e-body">
            The page you're looking for doesn't exist or may have been moved.
            Check the URL or head back to a familiar place.
        </p>

        <div class="e-actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="e-btn e-btn--primary">
                    <span class="iconify" data-icon="hugeicons:home-01" data-width="15" data-height="15"></span>
                    Go to Dashboard
                </a>
            @else
                <a href="{{ url('/') }}" class="e-btn e-btn--primary">
                    <span class="iconify" data-icon="hugeicons:home-01" data-width="15" data-height="15"></span>
                    Back to Home
                </a>
            @endauth

            <a href="javascript:history.back()" class="e-btn e-btn--ghost">
                <span class="iconify" data-icon="hugeicons:arrow-left-01" data-width="15" data-height="15"></span>
                Go Back
            </a>
        </div>

        <div class="e-divider"><span>or jump to</span></div>

        @auth
            <div class="e-links">
                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.courses.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:book-open-02" data-width="15" data-height="15"></span>
                        </div>
                        My Courses
                    </a>
                    <a href="{{ route('student.appointments.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:calendar-02" data-width="15" data-height="15"></span>
                        </div>
                        Appointments
                    </a>
                    <a href="{{ route('student.messages.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:message-02" data-width="15" data-height="15"></span>
                        </div>
                        Messages
                    </a>
                    <a href="{{ route('student.profile') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:user-circle" data-width="15" data-height="15"></span>
                        </div>
                        My Profile
                    </a>
                @elseif(auth()->user()->isAdvisor())
                    <a href="{{ route('advisor.students.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:student" data-width="15" data-height="15"></span>
                        </div>
                        My Students
                    </a>
                    <a href="{{ route('advisor.appointments.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:calendar-02" data-width="15" data-height="15"></span>
                        </div>
                        Appointments
                    </a>
                    <a href="{{ route('advisor.messages.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:message-02" data-width="15" data-height="15"></span>
                        </div>
                        Messages
                    </a>
                    <a href="{{ route('advisor.profile') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:user-circle" data-width="15" data-height="15"></span>
                        </div>
                        My Profile
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index', ['role' => 'student']) }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:student" data-width="15" data-height="15"></span>
                        </div>
                        Students
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'advisor']) }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:teacher" data-width="15" data-height="15"></span>
                        </div>
                        Advisors
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:book-open-02" data-width="15" data-height="15"></span>
                        </div>
                        Courses
                    </a>
                    <a href="{{ route('admin.assignments.index') }}" class="e-link">
                        <div class="e-link__icon">
                            <span class="iconify" data-icon="hugeicons:user-multiple-02" data-width="15" data-height="15"></span>
                        </div>
                        Assignments
                    </a>
                @endif
            </div>
        @else
            <div class="e-links" style="grid-template-columns:1fr 1fr">
                <a href="{{ route('login') }}" class="e-link">
                    <div class="e-link__icon">
                        <span class="iconify" data-icon="hugeicons:login-01" data-width="15" data-height="15"></span>
                    </div>
                    Sign In
                </a>
                <a href="{{ url('/') }}" class="e-link">
                    <div class="e-link__icon">
                        <span class="iconify" data-icon="hugeicons:home-01" data-width="15" data-height="15"></span>
                    </div>
                    Home
                </a>
            </div>
        @endauth

    </div>
</main>

<footer class="e-footer">
    &copy; {{ date('Y') }} Student Academic Advisory System
</footer>

</body>
</html>
