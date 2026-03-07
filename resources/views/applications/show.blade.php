@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    /* ─── Tokens ─────────────────────────────────────── */
    :root {
        --ad-bg:          #f0f2f7;
        --ad-surface:     #ffffff;
        --ad-border:      #e4e8f0;
        --ad-text:        #111827;
        --ad-muted:       #6b7280;
        --ad-subtle:      #9ca3af;
        --ad-accent:      #2563eb;
        --ad-accent-soft: #eff4ff;
        --ad-radius:      14px;
        --ad-radius-sm:   9px;
        --ad-shadow-sm:   0 1px 3px rgba(0,0,0,.06);
        --ad-shadow:      0 4px 20px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --ad-shadow-lg:   0 10px 36px rgba(15,23,42,.10), 0 2px 8px rgba(15,23,42,.05);
        --ad-font:        'DM Sans', sans-serif;
        --ad-mono:        'DM Mono', monospace;
    }

    /* ─── Page ───────────────────────────────────────── */
    .ad-page {
        font-family: var(--ad-font);
        background: var(--ad-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3.5rem;
        box-sizing: border-box;
    }

    /* ─── Back Link ──────────────────────────────────── */
    .ad-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--ad-muted);
        text-decoration: none;
        margin-bottom: 1.5rem;
        transition: color .15s;
    }

    .ad-back:hover { color: var(--ad-accent); text-decoration: none; }

    .ad-back svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Hero Card ──────────────────────────────────── */
    .ad-hero {
        background: var(--ad-surface);
        border: 1px solid var(--ad-border);
        border-radius: var(--ad-radius);
        box-shadow: var(--ad-shadow-lg);
        padding: 2rem 2.25rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 2rem;
        flex-wrap: wrap;
        position: relative;
        overflow: hidden;
        animation: fadeUp .4s ease both;
    }

    /* decorative gradient blob */
    .ad-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(37,99,235,.07) 0%, transparent 70%);
        pointer-events: none;
    }

    .ad-hero-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--ad-accent-soft);
        border: 1px solid #c7d9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-bottom: .85rem;
    }

    .ad-hero-icon svg {
        width: 24px; height: 24px;
        stroke: var(--ad-accent); fill: none;
        stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
    }

    .ad-hero-left { flex: 1; min-width: 240px; }

    .ad-hero-eyebrow {
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--ad-accent);
        margin: 0 0 .5rem;
    }

    .ad-hero-title {
        font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 700;
        color: var(--ad-text);
        letter-spacing: -.025em;
        line-height: 1.2;
        margin: 0 0 .75rem;
    }

    .ad-hero-desc {
        color: var(--ad-muted);
        font-size: .9rem;
        line-height: 1.7;
        max-width: 65ch;
        margin: 0;
    }

    /* Stats strip */
    .ad-hero-stats {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        align-self: flex-start;
        padding: 1rem 1.25rem;
        background: var(--ad-bg);
        border: 1px solid var(--ad-border);
        border-radius: var(--ad-radius-sm);
    }

    .ad-hero-stat {
        display: flex;
        flex-direction: column;
        gap: .2rem;
        text-align: center;
        min-width: 60px;
    }

    .ad-hero-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--ad-text);
        font-family: var(--ad-mono);
        letter-spacing: -.03em;
        line-height: 1;
    }

    .ad-hero-stat-label {
        font-size: .68rem;
        font-weight: 600;
        color: var(--ad-muted);
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .ad-hero-stat-divider {
        width: 1px;
        background: var(--ad-border);
        align-self: stretch;
    }

    /* ─── Section Title ──────────────────────────────── */
    .ad-section-title {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--ad-muted);
        margin: 0 0 1rem;
    }

    /* ─── Environment Grid ───────────────────────────── */
    .ad-env-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    /* ─── Environment Card ───────────────────────────── */
    .ad-env-card {
        background: var(--ad-surface);
        border: 1px solid var(--ad-border);
        border-radius: var(--ad-radius);
        box-shadow: var(--ad-shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        animation: fadeUp .45s ease both;
    }

    .ad-env-card:nth-child(1) { animation-delay: .05s; }
    .ad-env-card:nth-child(2) { animation-delay: .12s; }
    .ad-env-card:nth-child(3) { animation-delay: .19s; }
    .ad-env-card:nth-child(4) { animation-delay: .26s; }

    .ad-env-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--ad-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
    }

    .ad-env-label-wrap {
        display: flex;
        align-items: center;
        gap: .6rem;
    }

    .ad-env-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: var(--env-color, var(--ad-accent));
        box-shadow: 0 0 0 3px var(--env-glow, rgba(37,99,235,.15));
        flex-shrink: 0;
    }

    .ad-env-name {
        font-size: .9rem;
        font-weight: 700;
        color: var(--ad-text);
        letter-spacing: -.01em;
    }

    .ad-env-count {
        display: inline-flex;
        align-items: center;
        padding: .22rem .65rem;
        background: var(--env-soft, var(--ad-accent-soft));
        color: var(--env-color, var(--ad-accent));
        border-radius: 999px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .04em;
    }

    .ad-env-body {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: .65rem;
    }

    /* ─── Server Item ────────────────────────────────── */
    .ad-server {
        border: 1px solid var(--ad-border);
        border-radius: var(--ad-radius-sm);
        padding: .9rem 1rem;
        background: #fafbfd;
        transition: box-shadow .18s, border-color .18s;
    }

    .ad-server:hover {
        box-shadow: var(--ad-shadow-sm);
        border-color: #c7d9fd;
        background: #fff;
    }

    .ad-server-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .5rem;
        margin-bottom: .6rem;
    }

    .ad-server-name {
        font-size: .875rem;
        font-weight: 700;
        color: var(--ad-text);
        letter-spacing: -.01em;
        line-height: 1.3;
    }

    .ad-server-pills {
        display: flex;
        flex-wrap: wrap;
        gap: .35rem;
        margin-bottom: .55rem;
    }

    .ad-pill {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .22rem .6rem;
        background: var(--ad-bg);
        border: 1px solid var(--ad-border);
        border-radius: 999px;
        font-size: .73rem;
        font-weight: 600;
        color: #374151;
        font-family: var(--ad-mono);
    }

    .ad-pill svg {
        width: 11px; height: 11px;
        stroke: var(--ad-muted); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        flex-shrink: 0;
    }

    .ad-server-notes {
        font-size: .8rem;
        color: var(--ad-muted);
        line-height: 1.55;
        margin: 0;
        border-top: 1px solid var(--ad-border);
        padding-top: .5rem;
    }

    .ad-server-notes-empty {
        font-style: italic;
        color: var(--ad-subtle);
    }

    /* ─── Empty State ────────────────────────────────── */
    .ad-empty {
        flex: 1;
        border: 1.5px dashed #d1d9e6;
        border-radius: var(--ad-radius-sm);
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        gap: .5rem;
        text-align: center;
    }

    .ad-empty svg {
        width: 22px; height: 22px;
        stroke: #cbd5e1; fill: none;
        stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
        margin-bottom: .15rem;
    }

    .ad-empty p {
        font-size: .8rem;
        color: var(--ad-subtle);
        margin: 0;
    }

    /* ─── Animations ─────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 1199px) {
        .ad-env-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 767px) {
        .ad-page        { padding: 1.25rem 1rem 2.5rem; }
        .ad-hero        { padding: 1.25rem; }
        .ad-hero-stats  { width: 100%; justify-content: space-around; }
        .ad-env-grid    { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="ad-page">

    {{-- ── Back ─────────────────────────────────────── --}}
    <a class="ad-back" href="{{ route('applications.index') }}">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Uygulamalara Dön
    </a>

    {{-- ── Hero ─────────────────────────────────────── --}}
    <section class="ad-hero">
        <div class="ad-hero-left">
            <div class="ad-hero-icon">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            </div>
            <p class="ad-hero-eyebrow">Uygulama Detayı</p>
            <h1 class="ad-hero-title">{{ $application->name }}</h1>
            <p class="ad-hero-desc">
                {{ $application->description ?: 'Bu uygulama için açıklama bulunmuyor.' }}
            </p>
        </div>

        <div class="ad-hero-stats">
            <div class="ad-hero-stat">
                <span class="ad-hero-stat-value">{{ collect($groupedServers)->flatten()->count() }}</span>
                <span class="ad-hero-stat-label">Toplam Sunucu</span>
            </div>
            <div class="ad-hero-stat-divider"></div>
            <div class="ad-hero-stat">
                <span class="ad-hero-stat-value">{{ count($environments) }}</span>
                <span class="ad-hero-stat-label">Ortam</span>
            </div>
            @php
                $activeEnvs = collect($environments)->filter(fn($e) => isset($groupedServers[$e]) && $groupedServers[$e]->isNotEmpty())->count();
            @endphp
            <div class="ad-hero-stat-divider"></div>
            <div class="ad-hero-stat">
                <span class="ad-hero-stat-value">{{ $activeEnvs }}</span>
                <span class="ad-hero-stat-label">Aktif Ortam</span>
            </div>
        </div>
    </section>

    {{-- ── Environments ─────────────────────────────── --}}
    <p class="ad-section-title">Ortamlar & Sunucular</p>

    @php
        $envStyles = [
            'Test'     => ['color' => '#d97706', 'glow' => 'rgba(217,119,6,.15)',  'soft' => '#fffbeb'],
            'Pre-Prod' => ['color' => '#0891b2', 'glow' => 'rgba(8,145,178,.15)',  'soft' => '#ecfeff'],
            'Prod'     => ['color' => '#16a34a', 'glow' => 'rgba(22,163,74,.15)',  'soft' => '#f0fdf4'],
        ];
        $defaultStyle = ['color' => '#2563eb', 'glow' => 'rgba(37,99,235,.15)', 'soft' => '#eff4ff'];
    @endphp

    <div class="ad-env-grid">
        @foreach($environments as $environment)
            @php
                $servers = $groupedServers[$environment] ?? collect();
                $style   = $envStyles[$environment] ?? $defaultStyle;
            @endphp

            <article
                class="ad-env-card"
                style="--env-color:{{ $style['color'] }}; --env-glow:{{ $style['glow'] }}; --env-soft:{{ $style['soft'] }};"
            >
                {{-- Card Header --}}
                <header class="ad-env-header">
                    <div class="ad-env-label-wrap">
                        <span class="ad-env-dot"></span>
                        <span class="ad-env-name">{{ $environment }}</span>
                    </div>
                    <span class="ad-env-count">{{ $servers->count() }} sunucu</span>
                </header>

                {{-- Card Body --}}
                <div class="ad-env-body">
                    @if($servers->isNotEmpty())
                        @foreach($servers as $server)
                            <div class="ad-server">
                                <div class="ad-server-header">
                                    <span class="ad-server-name">{{ $server->name }}</span>
                                </div>
                                <div class="ad-server-pills">
                                    <span class="ad-pill">
                                        <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                                        {{ $server->ip_address }}
                                    </span>
                                    <span class="ad-pill">
                                        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="5" rx="2"/><rect x="2" y="10" width="20" height="5" rx="2"/><rect x="2" y="17" width="20" height="4" rx="2"/></svg>
                                        {{ $server->operatingSystem->name }}
                                    </span>
                                </div>
                                @if($server->notes)
                                    <p class="ad-server-notes">{{ $server->notes }}</p>
                                @else
                                    <p class="ad-server-notes ad-server-notes-empty">Not bulunmuyor.</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="ad-empty">
                            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            <p>Bu ortam için sunucu eklenmemiş.</p>
                        </div>
                    @endif
                </div>
            </article>
        @endforeach
    </div>

</div>
@endsection