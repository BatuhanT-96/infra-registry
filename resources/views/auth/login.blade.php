<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş - Uygulama Envanter Yönetimi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #f0f2f7;
            --surface:     #ffffff;
            --border:      #e4e8f0;
            --text:        #111827;
            --muted:       #6b7280;
            --subtle:      #9ca3af;
            --accent:      #2563eb;
            --accent-dark: #1d4ed8;
            --accent-soft: #eff4ff;
            --red:         #dc2626;
            --red-soft:    #fef2f2;
            --red-border:  #fecaca;
            --radius:      14px;
            --radius-sm:   9px;
            --shadow:      0 8px 32px rgba(15,23,42,.10), 0 2px 8px rgba(15,23,42,.06);
            --font:        'DM Sans', sans-serif;
            --mono:        'DM Mono', monospace;
        }

        html, body {
            height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
        }

        /* ── Layout ───────────────────────────────────── */
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }

        /* subtle background grid pattern */
        .login-page::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: .5;
            pointer-events: none;
        }

        /* radial glow */
        .login-page::after {
            content: '';
            position: fixed;
            top: -120px; left: 50%;
            transform: translateX(-50%);
            width: 700px; height: 500px;
            background: radial-gradient(ellipse at center, rgba(37,99,235,.09) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Card ─────────────────────────────────────── */
        .login-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2.5rem 2.25rem 2.25rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            animation: fadeUp .45s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Logo ─────────────────────────────────────── */
        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.75rem;
        }

        .login-logo img {
            height: 52px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        /* ── Header ───────────────────────────────────── */
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.02em;
            margin-bottom: .35rem;
        }

        .login-subtitle {
            font-size: .855rem;
            color: var(--muted);
        }

        /* ── Alert ────────────────────────────────────── */
        .login-alert {
            display: flex;
            align-items: flex-start;
            gap: .7rem;
            background: var(--red-soft);
            border: 1px solid var(--red-border);
            border-radius: var(--radius-sm);
            padding: .8rem .9rem;
            margin-bottom: 1.35rem;
            animation: fadeUp .3s ease;
        }

        .login-alert svg {
            width: 16px; height: 16px; flex-shrink: 0; margin-top: .1rem;
            stroke: var(--red); fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        .login-alert p {
            font-size: .825rem;
            color: #b91c1c;
            font-weight: 500;
            margin: 0;
            line-height: 1.55;
        }

        /* ── Form ─────────────────────────────────────── */
        .login-fields {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            margin-bottom: 1.4rem;
        }

        .login-field {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .login-label {
            font-size: .825rem;
            font-weight: 700;
            color: var(--text);
        }

        .login-input-wrap { position: relative; }

        .login-input-icon {
            position: absolute; left: .85rem; top: 50%;
            transform: translateY(-50%);
            display: flex; align-items: center;
            pointer-events: none;
        }

        .login-input-icon svg {
            width: 15px; height: 15px;
            stroke: var(--subtle); fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        .login-input {
            width: 100%;
            font-family: var(--font);
            font-size: .9rem;
            color: var(--text);
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            outline: none;
            padding: 0 2.6rem 0 2.5rem;
            height: 46px;
            box-sizing: border-box;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .login-input::placeholder { color: #9ca3af; }

        .login-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
            background: #fff;
        }

        .login-mono { font-family: var(--mono); font-size: .875rem; }

        /* eye toggle */
        .login-eye {
            position: absolute; right: .8rem; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0;
            display: flex; align-items: center;
            color: var(--subtle);
            transition: color .15s;
        }

        .login-eye:hover { color: var(--accent); }

        .login-eye svg {
            width: 16px; height: 16px;
            stroke: currentColor; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        /* ── Submit ───────────────────────────────────── */
        .login-submit {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-family: var(--font);
            font-size: .925rem;
            font-weight: 700;
            padding: .75rem;
            border-radius: var(--radius-sm);
            border: none;
            background: var(--accent);
            color: #fff;
            cursor: pointer;
            letter-spacing: .01em;
            box-shadow: 0 2px 10px rgba(37,99,235,.30);
            transition: background .18s, box-shadow .18s, transform .14s;
        }

        .login-submit:hover {
            background: var(--accent-dark);
            box-shadow: 0 4px 16px rgba(37,99,235,.40);
            transform: translateY(-1px);
        }

        .login-submit:active { transform: translateY(0); }

        .login-submit svg {
            width: 16px; height: 16px;
            stroke: currentColor; fill: none;
            stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
        }

        /* ── Footer note ──────────────────────────────── */
        .login-note {
            text-align: center;
            margin-top: 1.5rem;
            font-size: .75rem;
            color: var(--subtle);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
        }

        .login-note svg {
            width: 12px; height: 12px;
            stroke: var(--subtle); fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="login-card">

        {{-- Logo --}}
        <div class="login-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        {{-- Header --}}
        <div class="login-header">
            <h1 class="login-title">Hoş Geldiniz</h1>
            <p class="login-subtitle">Devam etmek için hesabınıza giriş yapın.</p>
        </div>

        {{-- Error --}}
        @if($errors->any())
            <div class="login-alert">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="login-alert">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="login-fields">

                {{-- Username --}}
                <div class="login-field">
                    <label class="login-label" for="username">Kullanıcı Adı</label>
                    <div class="login-input-wrap">
                        <span class="login-input-icon">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        </span>
                        <input
                            class="login-input login-mono"
                            id="username"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="kullanici_adi"
                            required
                            autocomplete="username"
                            autocapitalize="none"
                            autofocus
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="login-field">
                    <label class="login-label" for="password">Şifre</label>
                    <div class="login-input-wrap">
                        <span class="login-input-icon">
                            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        </span>
                        <input
                            class="login-input"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="login-eye" onclick="togglePwd()" aria-label="Şifreyi göster/gizle">
                            <svg id="eye-icon" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>

            </div>

            <button class="login-submit" type="submit">
                <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Giriş Yap
            </button>
        </form>

        <p class="login-note">
            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Güvenli bağlantı
        </p>

    </div>
</div>

<script>
function togglePwd() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    icon.innerHTML = show
        ? '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}
</script>
</body>
</html>