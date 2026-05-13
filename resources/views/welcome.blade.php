<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAS - Student Academic Advisory System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/3/3.1.1/iconify.min.js" defer></script>

    <style>
        :root {
            /* ── mirrors dashboard app.blade.php exactly ── */
            --navy:      #0f1729;   /* sidebar-bg */
            --navy-mid:  #1346b8;   /* primary-dark */
            --navy-dark: #070c17;
            --blue:      #1a56db;   /* primary */
            --blue-lt:   #60a5fa;   /* light blue - readable on dark bg */
            --body-bg:   #f4f6fb;   /* dashboard page background */
            --body-bg-dk:#e8edf5;
            --white:     #FFFFFF;
            --text:      #1e293b;   /* dashboard main text */
            --muted:     #64748b;   /* dashboard --muted */
            --border:    #e2e8f0;   /* dashboard --card-border */
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--white);
            color: var(--text);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVBAR ── */
        .s-nav {
            position: sticky;
            top: 0;
            z-index: 200;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .s-nav__inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .s-nav__brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: var(--text);
        }

        .s-nav__logo {
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

        .s-nav__wordmark {
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text);
        }

        .s-nav__wordmark em {
            font-style: normal;
            color: var(--blue);
        }

        .s-nav__links {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .s-nav__link {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            font-size: 0.88rem;
            padding: 0.5rem 1rem;
            transition: color 0.15s;
        }

        .s-nav__link:hover { color: var(--blue); }

        .s-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            letter-spacing: 0.01em;
            white-space: nowrap;
        }

        .s-btn--navy {
            background: var(--blue);
            color: var(--white);
            padding: 0.55rem 1.4rem;
            border-radius: 8px;
        }

        .s-btn--navy:hover {
            background: var(--navy-mid);
            color: var(--white);
        }

        .s-btn--gold {
            background: var(--blue);
            color: var(--white);
            padding: 0.85rem 2rem;
            border-radius: 8px;
        }

        .s-btn--gold:hover {
            background: var(--navy-mid);
            color: var(--white);
        }

        .s-btn--outline {
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,0.28);
            padding: 0.85rem 2rem;
        }

        .s-btn--outline:hover {
            border-color: rgba(255,255,255,0.7);
            color: var(--white);
        }

        /* ── HERO ── */
        .s-hero {
            background: var(--navy);
            position: relative;
            overflow: hidden;
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .s-hero__bg {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .s-hero__inner {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
            width: 100%;
        }

        .s-hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(26,86,219,0.4);
            background: rgba(26,86,219,0.15);
            color: var(--blue-lt);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.38rem 0.9rem;
            margin-bottom: 2rem;
        }

        .s-hero__title {
            font-size: clamp(3rem, 6.5vw, 5.5rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.03;
            letter-spacing: -0.025em;
            margin-bottom: 1.5rem;
        }

        .s-hero__title .t-gold { color: var(--blue-lt); }

        .s-hero__sub {
            font-size: 1.05rem;
            font-weight: 400;
            color: rgba(148,163,184,0.85);
            max-width: 500px;
            line-height: 1.75;
            margin-bottom: 2.5rem;
        }

        .s-hero__ctas {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            flex-wrap: wrap;
        }

        .s-hero__metrics {
            display: flex;
            gap: 2.5rem;
            margin-top: 4rem;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            flex-wrap: wrap;
        }

        .s-hero__metric-num {
            font-size: 2rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .s-hero__metric-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(148,163,184,0.7);
            margin-top: 0.3rem;
        }

        /* Dashboard preview card */
        .s-dash {
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
        }

        .s-dash__head {
            padding: 0.9rem 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .s-dash__label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--blue-lt);
        }

        .s-dash__body { padding: 1rem 1.2rem; }

        .s-dash__row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.45rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 0.8rem;
        }

        .s-dash__row:last-child { border-bottom: none; }

        .s-dash__course { color: rgba(255,255,255,0.6); }

        .s-dash__grade { font-weight: 700; color: var(--white); }

        .g-a { color: #4ADE80; }
        .g-b { color: #60A5FA; }
        .g-c { color: #f59e0b; }

        .s-dash__bar-wrap {
            padding: 1rem 1.2rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .s-dash__bar-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.72rem;
            margin-bottom: 0.45rem;
        }

        .s-dash__bar-title { color: rgba(255,255,255,0.4); font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; }
        .s-dash__bar-val   { color: var(--white); font-weight: 700; }

        .s-bar {
            height: 4px;
            background: rgba(255,255,255,0.08);
        }

        .s-bar__fill {
            height: 100%;
            background: var(--blue);
        }

        .s-appt {
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin-top: 0.85rem;
        }

        .s-appt__avatar {
            width: 38px;
            height: 38px;
            background: rgba(26,86,219,0.25);
            border: 1px solid rgba(26,86,219,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue-lt);
            border-radius: 8px;
            flex-shrink: 0;
        }

        .s-appt__name { font-size: 0.83rem; font-weight: 600; color: var(--white); }
        .s-appt__role { font-size: 0.72rem; color: rgba(148,163,184,0.7); margin-top: 0.1rem; }
        .s-appt__time { margin-left: auto; text-align: right; flex-shrink: 0; }
        .s-appt__day  { font-size: 0.72rem; font-weight: 700; color: var(--blue-lt); }
        .s-appt__hour { font-size: 0.68rem; color: rgba(148,163,184,0.6); margin-top: 0.1rem; }

        /* ── SECTION BASE ── */
        .s-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .s-eyebrow {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 0.6rem;
        }

        .s-heading {
            font-size: clamp(1.75rem, 3.2vw, 2.75rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin-bottom: 0.9rem;
        }

        .s-body {
            font-size: 0.97rem;
            color: var(--muted);
            line-height: 1.75;
            max-width: 500px;
        }

        /* ── ROLES ── */
        .s-roles {
            background: var(--body-bg);
            padding: 5.5rem 0;
        }

        .s-role {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2.25rem;
            height: 100%;
            transition: border-color 0.18s, box-shadow 0.18s, transform 0.22s;
        }

        .s-role:hover {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.08);
            transform: translateY(-4px);
        }

        .s-role--featured {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.08);
        }

        .s-role__icon {
            width: 46px;
            height: 46px;
            background: #eff6ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            margin-bottom: 1.4rem;
        }

        .s-role__icon--primary {
            background: var(--blue);
            color: var(--white);
        }

        .s-role__title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .s-role__desc {
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 1.4rem;
        }

        .s-checklist {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .s-checklist li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.845rem;
            color: var(--text);
            padding: 0.35rem 0;
            border-bottom: 1px solid var(--body-bg-dk);
        }

        .s-checklist li:last-child { border-bottom: none; }

        .s-checklist .iconify { color: var(--blue); flex-shrink: 0; }

        /* ── FEATURES ── */
        .s-features {
            background: var(--white);
            padding: 5.5rem 0;
        }

        .s-feat {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.9rem;
            height: 100%;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .s-feat:hover {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.07);
        }

        .s-feat__icon {
            width: 42px;
            height: 42px;
            background: #eff6ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue);
            margin-bottom: 1rem;
        }

        .s-feat__title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 0.35rem;
        }

        .s-feat__desc {
            font-size: 0.86rem;
            color: var(--muted);
            line-height: 1.65;
            margin: 0;
        }

        /* ── STATS ── */
        .s-stats {
            background: var(--gold);
            padding: 4rem 0;
        }

        .s-stats__grid {
            display: flex;
            justify-content: center;
            align-items: stretch;
            flex-wrap: wrap;
        }

        .s-stat {
            text-align: center;
            padding: 1rem 3rem;
        }

        .s-stat__num {
            font-size: 3rem;
            font-weight: 900;
            color: var(--navy);
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .s-stat__label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(13,31,60,0.55);
            margin-top: 0.45rem;
        }

        .s-stat__div {
            width: 1px;
            background: rgba(13,31,60,0.18);
            margin: 0.5rem 0;
            align-self: stretch;
        }

        /* ── CTA ── */
        .s-cta {
            background: var(--navy);
            padding: 5.5rem 0;
            text-align: center;
        }

        .s-cta .s-eyebrow { color: var(--blue-lt); }

        /* ── FOOTER ── */
        .s-footer {
            background: var(--navy-dark);
            padding: 1.75rem 0;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .s-footer__inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .s-footer__brand {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
        }

        .s-footer__brand em {
            font-style: normal;
            color: var(--blue-lt);
        }

        .s-footer__copy {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.22);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fu   { animation: fadeUp 0.75s cubic-bezier(0.22,1,0.36,1) both; }
        .fu-1 { animation-delay: 0.08s; }
        .fu-2 { animation-delay: 0.18s; }
        .fu-3 { animation-delay: 0.3s;  }
        .fu-4 { animation-delay: 0.44s; }
        .fu-5 { animation-delay: 0.58s; }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            .s-hero__visual { display: none; }
            .s-stat { padding: 1rem 2rem; }
            .s-stat__div { display: none; }
        }

        @media (max-width: 576px) {
            .s-hero__metrics { gap: 1.5rem; }
            .s-nav__inner { padding: 0.9rem 1.25rem; }
            .s-wrap { padding: 0 1.25rem; }
        }
    </style>
</head>
<body>

{{-- ════════════════════════════════
     NAVBAR
════════════════════════════════ --}}
<nav class="s-nav">
    <div class="s-nav__inner">
        <a href="/" class="s-nav__brand">
            <div class="s-nav__logo">
                <span class="iconify" data-icon="hugeicons:mortarboard-01" data-width="18" data-height="18"></span>
            </div>
            <span class="s-nav__wordmark">S<em>A</em>S</span>
        </a>

        <div class="s-nav__links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="s-btn s-btn--navy">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="s-nav__link">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="s-btn s-btn--navy">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

{{-- ════════════════════════════════
     HERO
════════════════════════════════ --}}
<section class="s-hero">
    {{-- SVG grid pattern - no CSS gradients --}}
    <div class="s-hero__bg" aria-hidden="true">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;inset:0">
            <defs>
                <pattern id="pg" width="64" height="64" patternUnits="userSpaceOnUse">
                    <path d="M 64 0 L 0 0 0 64" fill="none" stroke="rgba(244,239,230,0.055)" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#pg)"/>
        </svg>
        {{-- Concentric rings --}}
        <svg width="680" height="680" viewBox="0 0 680 680"
             style="position:absolute;right:-180px;top:-120px;opacity:0.035"
             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="340" cy="340" r="320" fill="none" stroke="#F4EFE6" stroke-width="1"/>
            <circle cx="340" cy="340" r="240" fill="none" stroke="#F4EFE6" stroke-width="1"/>
            <circle cx="340" cy="340" r="160" fill="none" stroke="#F4EFE6" stroke-width="1"/>
            <circle cx="340" cy="340" r="80"  fill="none" stroke="#F4EFE6" stroke-width="1"/>
        </svg>
        {{-- Corner accent lines --}}
        <svg width="200" height="200" viewBox="0 0 200 200"
             style="position:absolute;left:0;bottom:0;opacity:0.04"
             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <line x1="0" y1="200" x2="200" y2="0" stroke="#F4EFE6" stroke-width="1"/>
            <line x1="0" y1="160" x2="160" y2="0" stroke="#F4EFE6" stroke-width="1"/>
            <line x1="0" y1="120" x2="120" y2="0" stroke="#F4EFE6" stroke-width="1"/>
        </svg>
    </div>

    <div class="s-hero__inner">
        <div class="row align-items-center g-5">

            {{-- Left: copy --}}
            <div class="col-lg-6">
                <div class="s-hero__eyebrow fu">
                    <span class="iconify" data-icon="hugeicons:mortarboard-01" data-width="13" data-height="13"></span>
                    Academic Advisory System
                </div>

                <h1 class="s-hero__title fu fu-1">
                    Your Academic<br>
                    Journey,<br>
                    <span class="t-gold">Guided.</span>
                </h1>

                <p class="s-hero__sub fu fu-2">
                    A centralised platform connecting students with their academic advisors - track progress, book appointments, and get the guidance you need to succeed.
                </p>

                <div class="s-hero__ctas fu fu-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="s-btn s-btn--gold">
                                Go to Dashboard
                                <span class="iconify" data-icon="hugeicons:arrow-right-01" data-width="15" data-height="15"></span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="s-btn s-btn--gold">
                                Sign In to Portal
                                <span class="iconify" data-icon="hugeicons:arrow-right-01" data-width="15" data-height="15"></span>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="s-btn s-btn--outline">
                                    Create Account
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <div class="s-hero__metrics fu fu-4">
                    <div>
                        <div class="s-hero__metric-num">100%</div>
                        <div class="s-hero__metric-label">Web-Based</div>
                    </div>
                    <div>
                        <div class="s-hero__metric-num">24/7</div>
                        <div class="s-hero__metric-label">Always On</div>
                    </div>
                </div>
            </div>

            {{-- Right: dashboard preview --}}
            <div class="col-lg-6 s-hero__visual fu fu-5">
                {{-- Course grades card --}}
                <div class="s-dash mb-3">
                    <div class="s-dash__head">
                        <span class="s-dash__label">
                            <span class="iconify me-1" data-icon="hugeicons:chart-histogram" data-width="11" data-height="11"></span>
                            Academic Progress - ND1
                        </span>
                        <span style="font-size:0.68rem;color:rgba(255,255,255,0.25);font-weight:500">2025/2026</span>
                    </div>
                    <div class="s-dash__body">
                        <div class="s-dash__row">
                            <span class="s-dash__course">MTH 101 - Mathematics</span>
                            <span class="s-dash__grade g-a">A &middot; 87</span>
                        </div>
                        <div class="s-dash__row">
                            <span class="s-dash__course">CSC 102 - Intro to Computing</span>
                            <span class="s-dash__grade g-b">B &middot; 74</span>
                        </div>
                        <div class="s-dash__row">
                            <span class="s-dash__course">COM 103 - Communication</span>
                            <span class="s-dash__grade g-a">A &middot; 81</span>
                        </div>
                        <div class="s-dash__row">
                            <span class="s-dash__course">ENG 104 - Technical Drawing</span>
                            <span class="s-dash__grade g-c">C &middot; 61</span>
                        </div>
                    </div>
                    <div class="s-dash__bar-wrap">
                        <div class="s-dash__bar-meta">
                            <span class="s-dash__bar-title">CGPA</span>
                            <span class="s-dash__bar-val">3.62 / 5.0</span>
                        </div>
                        <div class="s-bar">
                            <div class="s-bar__fill" style="width:72.4%"></div>
                        </div>
                    </div>
                </div>

                {{-- Appointment card --}}
                <div class="s-appt">
                    <div class="s-appt__avatar">
                        <span class="iconify" data-icon="hugeicons:user-circle" data-width="20" data-height="20"></span>
                    </div>
                    <div>
                        <div class="s-appt__name">Dr. Adebayo Okafor</div>
                        <div class="s-appt__role">Academic Advisor</div>
                    </div>
                    <div class="s-appt__time">
                        <div class="s-appt__day">Tomorrow</div>
                        <div class="s-appt__hour">10:00 AM</div>
                    </div>
                    <div style="flex-shrink:0;margin-left:0.5rem">
                        <span style="display:inline-block;background:rgba(74,222,128,0.15);border:1px solid rgba(74,222,128,0.3);color:#4ADE80;font-size:0.65rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:0.2rem 0.5rem">
                            Confirmed
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ════════════════════════════════
     WHO IT'S FOR - ROLES
════════════════════════════════ --}}
<section class="s-roles">
    <div class="s-wrap">
        <div class="row mb-5 align-items-end">
            <div class="col-lg-5">
                <p class="s-eyebrow">Who It's For</p>
                <h2 class="s-heading">One platform.<br>Three roles.</h2>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <p class="s-body">Every user gets a tailored experience designed for their specific responsibilities within the academic advisory ecosystem.</p>
            </div>
        </div>

        <div class="row g-4">
            {{-- Student --}}
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="s-role w-100">
                    <div class="s-role__icon">
                        <span class="iconify" data-icon="hugeicons:student" data-width="24" data-height="24"></span>
                    </div>
                    <h3 class="s-role__title">Student</h3>
                    <p class="s-role__desc">Access your academic records, monitor your CGPA, and stay connected with your assigned advisor throughout your studies.</p>
                    <ul class="s-checklist">
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> View courses &amp; grades</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Track CGPA &amp; progress</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Book advisory appointments</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Message your advisor</li>
                    </ul>
                </div>
            </div>

            {{-- Advisor --}}
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="s-role s-role--featured w-100">
                    <div class="s-role__icon s-role__icon--primary">
                        <span class="iconify" data-icon="hugeicons:teacher" data-width="24" data-height="24"></span>
                    </div>
                    <h3 class="s-role__title">Academic Advisor</h3>
                    <p class="s-role__desc">Manage your student caseload, review academic performance, and guide students toward their educational goals.</p>
                    <ul class="s-checklist">
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> View assigned student profiles</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Approve or reject appointments</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Monitor student progress</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Direct messaging system</li>
                    </ul>
                </div>
            </div>

            {{-- Admin --}}
            <div class="col-lg-4 col-md-6 d-flex">
                <div class="s-role w-100">
                    <div class="s-role__icon">
                        <span class="iconify" data-icon="hugeicons:dashboard-speed-02" data-width="24" data-height="24"></span>
                    </div>
                    <h3 class="s-role__title">Administrator</h3>
                    <p class="s-role__desc">Full system oversight - manage users, assign advisors to students, maintain course records, and monitor institutional data.</p>
                    <ul class="s-checklist">
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> User &amp; account management</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Course &amp; grade administration</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Advisor–student assignments</li>
                        <li><span class="iconify" data-icon="hugeicons:checkmark-circle-01" data-width="15" data-height="15"></span> Institution-wide reporting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════
     FEATURES
════════════════════════════════ --}}
<section class="s-features">
    <div class="s-wrap">
        <div class="row mb-5 align-items-end">
            <div class="col-lg-5">
                <p class="s-eyebrow">Platform Features</p>
                <h2 class="s-heading">Everything you need in one place.</h2>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <p class="s-body">Built specifically for polytechnic advisory workflows - designed to reduce administrative friction and improve student outcomes.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:book-open-02" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">Course Management</h4>
                    <p class="s-feat__desc">Students see all enrolled courses with credit units, scores, and letter grades. Admins maintain the full course catalogue.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:chart-histogram" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">CGPA Tracking</h4>
                    <p class="s-feat__desc">Real-time grade point average calculation based on course scores, keeping students aware of their academic standing.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:calendar-02" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">Appointment Booking</h4>
                    <p class="s-feat__desc">Students request advisory sessions; advisors approve or decline with a clean, structured scheduling workflow.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:message-02" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">Secure Messaging</h4>
                    <p class="s-feat__desc">A private messaging channel between students and their assigned advisors</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:user-multiple-02" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">Role-Based Access</h4>
                    <p class="s-feat__desc">Three distinct user roles - Student, Advisor, and Admin - each with their own tailored dashboard and permissions.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex">
                <div class="s-feat w-100">
                    <div class="s-feat__icon">
                        <span class="iconify" data-icon="hugeicons:pencil-edit-02" data-width="20" data-height="20"></span>
                    </div>
                    <h4 class="s-feat__title">Score Entry</h4>
                    <p class="s-feat__desc">Administrators enter and manage student scores directly in the system, keeping academic records accurate and current.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════
     CTA
════════════════════════════════ --}}
<section class="s-cta">
    <div class="s-wrap text-center">
        <p class="s-eyebrow">Get Started</p>
        <h2 class="s-heading" style="color:var(--white);max-width:580px;margin:0 auto 1rem auto">
            Ready to take control of your academic journey?
        </h2>
        <p class="s-body" style="color:rgba(148,163,184,0.85);margin:0 auto 2.5rem auto;max-width:460px">
            Sign in to access your dashboard, connect with your advisor, and stay on top of your academic goals.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="s-btn s-btn--gold">
                        Go to Dashboard
                        <span class="iconify" data-icon="hugeicons:arrow-right-01" data-width="15" data-height="15"></span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="s-btn s-btn--gold">
                        Sign In
                        <span class="iconify" data-icon="hugeicons:arrow-right-01" data-width="15" data-height="15"></span>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="s-btn s-btn--outline">
                            Create an Account
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</section>

{{-- ════════════════════════════════
     FOOTER
════════════════════════════════ --}}
<footer class="s-footer">
    <div class="s-footer__inner">
        <div class="s-footer__brand">
            S<em>A</em>S - Student Academic Advisory System
        </div>
        <div class="s-footer__copy">
            &copy; {{ date('Y') }}
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
