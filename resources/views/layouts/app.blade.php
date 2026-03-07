<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <title>Envanter Yönetimi</title>
    <style>
        /* ─── Reset & Base ───────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w:     240px;
            --sidebar-bg:    #0d1117;
            --sidebar-border:#1e2632;
            --sidebar-text:  #8b949e;
            --sidebar-hover: #161b22;
            --sidebar-active:#1f6feb;
            --sidebar-active-bg: rgba(31,111,235,.12);
            --main-bg:       #f0f2f7;
            --font:          'DM Sans', sans-serif;
            --mono:          'DM Mono', monospace;
        }

        html, body { height: 100%; }

        body {
            font-family: var(--font);
            background: var(--main-bg);
            color: #111827;
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; }

        /* ─── Sidebar ────────────────────────────────── */
        .layout-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            overflow-y: auto;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: 1.4rem 1.25rem 1.1rem;
            border-bottom: 1px solid var(--sidebar-border);
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #1f6feb 0%, #388bfd 100%);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 10px rgba(31,111,235,.35);
        }

        .sidebar-brand-icon svg {
            width: 17px; height: 17px;
            stroke: #fff; fill: none;
            stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
            gap: .05rem;
        }

        .sidebar-brand-name {
            font-size: .875rem;
            font-weight: 700;
            color: #f0f6fc;
            letter-spacing: -.01em;
            line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: .68rem;
            color: var(--sidebar-text);
            font-weight: 500;
            letter-spacing: .02em;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 1rem .75rem;
            display: flex;
            flex-direction: column;
            gap: .15rem;
        }

        .sidebar-section-label {
            font-size: .62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #3d4f61;
            padding: .6rem .6rem .3rem;
            margin-top: .25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .55rem .75rem;
            border-radius: 8px;
            font-size: .845rem;
            font-weight: 500;
            color: var(--sidebar-text);
            transition: background .15s, color .15s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .sidebar-link svg {
            width: 15px; height: 15px;
            stroke: currentColor; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
            opacity: .7;
            transition: opacity .15s;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: #c9d1d9;
        }

        .sidebar-link:hover svg { opacity: 1; }

        .sidebar-link.active {
            background: var(--sidebar-active-bg);
            color: #58a6ff;
            font-weight: 600;
        }

        .sidebar-link.active svg {
            opacity: 1;
            stroke: #58a6ff;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 3px; height: 24px;
            background: #1f6feb;
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link { position: relative; }

        /* Divider */
        .sidebar-divider {
            border: none;
            border-top: 1px solid var(--sidebar-border);
            margin: .5rem 0;
        }

        /* Footer */
        .sidebar-footer {
            padding: .85rem .75rem 1.1rem;
            border-top: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            gap: .65rem;
        }

        /* User chip */
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .5rem .6rem;
            border-radius: 8px;
            background: var(--sidebar-hover);
        }

        .sidebar-user-avatar {
            width: 30px; height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, #1f6feb, #388bfd);
            display: flex; align-items: center; justify-content: center;
            font-size: .72rem; font-weight: 700; color: #fff;
            text-transform: uppercase;
            flex-shrink: 0;
            font-family: var(--mono);
        }

        .sidebar-user-info { flex: 1; min-width: 0; }

        .sidebar-user-name {
            font-size: .8rem; font-weight: 600;
            color: #c9d1d9;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            line-height: 1.3;
        }

        .sidebar-user-role {
            font-size: .68rem; color: var(--sidebar-text);
            line-height: 1.3;
        }

        /* Logout */
        .sidebar-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .5rem;
            border-radius: 7px;
            border: 1px solid var(--sidebar-border);
            background: transparent;
            color: var(--sidebar-text);
            font-family: var(--font);
            font-size: .8rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .15s, color .15s, border-color .15s;
            width: 100%;
        }

        .sidebar-logout svg {
            width: 13px; height: 13px;
            stroke: currentColor; fill: none;
            stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
        }

        .sidebar-logout:hover {
            background: rgba(220,38,38,.08);
            border-color: rgba(220,38,38,.3);
            color: #f87171;
        }

        /* Logo area */
        .sidebar-logo-area {
            padding: .65rem .75rem .1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .5rem;
            opacity: .35;
            transition: opacity .2s;
        }

        .sidebar-logo:hover { opacity: .6; }

        .sidebar-logo-mark {
            display: flex;
            gap: 2px;
        }

        .sidebar-logo-mark span {
            display: block;
            width: 4px;
            border-radius: 2px;
            background: #58a6ff;
        }

        .sidebar-logo-mark span:nth-child(1) { height: 10px; }
        .sidebar-logo-mark span:nth-child(2) { height: 16px; }
        .sidebar-logo-mark span:nth-child(3) { height: 7px; }
        .sidebar-logo-mark span:nth-child(4) { height: 13px; }

        .sidebar-logo-text {
            font-size: .7rem;
            font-weight: 700;
            color: #8b949e;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-family: var(--mono);
        }

        /* ─── Main ───────────────────────────────────── */
        .layout-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Flash messages */
        .layout-flash {
            padding: 1rem 2rem 0;
        }

        .flash-success {
            display: flex;
            align-items: center;
            gap: .65rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .875rem;
            color: #15803d;
            font-weight: 500;
            animation: fadeDown .3s ease;
        }

        .flash-success svg {
            width: 16px; height: 16px;
            stroke: #16a34a; fill: none;
            stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
        }

        .flash-error {
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: .75rem 1rem;
            font-size: .875rem;
            color: #b91c1c;
            animation: fadeDown .3s ease;
        }

        .flash-error svg {
            width: 16px; height: 16px;
            stroke: #dc2626; fill: none;
            stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0; margin-top: .1rem;
        }

        .flash-error ul { margin: 0; padding-left: 1rem; }
        .flash-error li { line-height: 1.7; }

        /* Content */
        .layout-content {
            flex: 1;
        }

        /* ─── Animations ─────────────────────────────── */
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── Scrollbar ──────────────────────────────── */
        .layout-sidebar::-webkit-scrollbar { width: 4px; }
        .layout-sidebar::-webkit-scrollbar-track { background: transparent; }
        .layout-sidebar::-webkit-scrollbar-thumb { background: #2d3748; border-radius: 2px; }

        /* ─── Responsive ─────────────────────────────── */
        @media (max-width: 767px) {
            :root { --sidebar-w: 200px; }
        }

        @media (max-width: 575px) {
            .layout-sidebar { transform: translateX(-100%); transition: transform .25s; }
            .layout-sidebar.open { transform: translateX(0); }
            .layout-main { margin-left: 0; }
        }

        /* ─── Bootstrap card-stat compat ────────────── */
        .card-stat {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }
        .sidebar-brand {
            flex-direction: column;
            align-items: center;
            padding: 1.25rem 1rem 1rem;
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ── Sidebar ───────────────────────────────────────── --}}
<aside class="layout-sidebar">

    {{-- Brand --}}
    <a class="sidebar-brand" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:100%; height:auto; object-fit:contain; display:block;">
        <div class="sidebar-brand-text">
            <span class="sidebar-brand-name">Envanter</span>
            <span class="sidebar-brand-sub">Yönetim Paneli</span>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <span class="sidebar-section-label">Genel</span>

        <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>

        <a class="sidebar-link {{ request()->routeIs('applications.*') ? 'active' : '' }}" href="{{ route('applications.index') }}">
            <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            Uygulamalar
        </a>

        <a class="sidebar-link {{ request()->routeIs('servers.*') ? 'active' : '' }}" href="{{ route('servers.index') }}">
            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="5" rx="2"/><rect x="2" y="10" width="20" height="5" rx="2"/><rect x="2" y="17" width="20" height="4" rx="2"/><line x1="6" y1="5.5" x2="6.01" y2="5.5"/><line x1="6" y1="12.5" x2="6.01" y2="12.5"/></svg>
            Sunucular
        </a>

        @if(auth()->user()?->isAdmin())
            <hr class="sidebar-divider">
            <span class="sidebar-section-label">Yönetim</span>

            <a class="sidebar-link {{ request()->routeIs('operating-systems.*') ? 'active' : '' }}" href="{{ route('operating-systems.index') }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                İşletim Sistemleri
            </a>

            <a class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Kullanıcı Yönetimi
            </a>
        @endif

    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">

        {{-- User chip --}}
        @auth
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ collect(explode(' ', auth()->user()->full_name))->map(fn($w) => mb_substr($w,0,1))->take(2)->implode('') }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->full_name }}</div>
                <div class="sidebar-user-role">{{ auth()->user()->isAdmin() ? 'Yönetici' : 'Kullanıcı' }}</div>
            </div>
        </div>
        @endauth

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="sidebar-logout" type="submit">
                <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Çıkış Yap
            </button>
        </form>

        {{-- Logo --}}
        <div class="sidebar-logo-area">
            <div class="sidebar-logo">
                <div class="sidebar-logo-mark">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span class="sidebar-logo-text">v1.0</span>
            </div>
        </div>

    </div>
</aside>

{{-- ── Main ──────────────────────────────────────────── --}}
<main class="layout-main">

    {{-- Flash Messages --}}
    @if(session('status') || $errors->any())
        <div class="layout-flash">
            @if(session('status'))
                <div class="flash-success">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="flash-error">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    {{-- Page Content --}}
    <div class="layout-content">
        @yield('content')
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>