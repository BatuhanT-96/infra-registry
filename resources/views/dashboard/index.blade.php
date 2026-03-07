@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    /* ─── Design Tokens ──────────────────────────────── */
    :root {
        --db-bg:          #f0f2f7;
        --db-surface:     #ffffff;
        --db-border:      #e4e8f0;
        --db-text:        #111827;
        --db-muted:       #6b7280;
        --db-accent:      #2563eb;
        --db-accent-soft: #eff4ff;
        --db-green:       #16a34a;
        --db-amber:       #d97706;
        --db-red:         #dc2626;
        --db-purple:      #7c3aed;
        --db-radius:      14px;
        --db-shadow-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --db-shadow:      0 4px 16px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --db-shadow-lg:   0 12px 40px rgba(15,23,42,.10), 0 2px 8px rgba(15,23,42,.05);
        --db-font:        'DM Sans', sans-serif;
        --db-mono:        'DM Mono', monospace;
    }

    /* ─── Base ───────────────────────────────────────── */
    .db-page {
        font-family: var(--db-font);
        background: var(--db-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3rem;
        box-sizing: border-box;
    }

    /* ─── Page Header ────────────────────────────────── */
    .db-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .db-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--db-text);
        margin: 0 0 .25rem;
        letter-spacing: -.02em;
        line-height: 1.2;
    }

    .db-header-left p {
        margin: 0;
        color: var(--db-muted);
        font-size: .875rem;
    }

    .db-badge-live {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: var(--db-green);
        font-size: .75rem;
        font-weight: 600;
        padding: .35rem .75rem;
        border-radius: 999px;
        letter-spacing: .02em;
    }

    .db-badge-live::before {
        content: '';
        width: 7px;
        height: 7px;
        background: var(--db-green);
        border-radius: 50%;
        box-shadow: 0 0 0 2.5px rgba(22,163,74,.2);
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 0 2.5px rgba(22,163,74,.2); }
        50%       { box-shadow: 0 0 0 5px rgba(22,163,74,.05); }
    }

    /* ─── Grid ───────────────────────────────────────── */
    .db-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.25rem;
    }

    /* ─── Stat Cards ─────────────────────────────────── */
    .db-stat {
        grid-column: span 2;
    }

    .db-stat-card {
        background: var(--db-surface);
        border: 1px solid var(--db-border);
        border-radius: var(--db-radius);
        padding: 1.25rem 1.35rem;
        box-shadow: var(--db-shadow-sm);
        height: 100%;
        box-sizing: border-box;
        position: relative;
        overflow: hidden;
        transition: box-shadow .2s, transform .2s;
    }

    .db-stat-card:hover {
        box-shadow: var(--db-shadow);
        transform: translateY(-2px);
    }

    /* coloured top bar */
    .db-stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: var(--stat-color, var(--db-accent));
        border-radius: var(--db-radius) var(--db-radius) 0 0;
    }

    .db-stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--stat-bg, var(--db-accent-soft));
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .85rem;
    }

    .db-stat-icon svg {
        width: 18px;
        height: 18px;
        stroke: var(--stat-color, var(--db-accent));
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .db-stat-label {
        font-size: .75rem;
        font-weight: 600;
        color: var(--db-muted);
        text-transform: uppercase;
        letter-spacing: .06em;
        margin: 0 0 .35rem;
    }

    .db-stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--db-text);
        letter-spacing: -.03em;
        line-height: 1;
        font-variant-numeric: tabular-nums;
        font-family: var(--db-mono);
    }

    /* ─── Chart Panels ───────────────────────────────── */
    .db-panel {
        grid-column: span 6;
        background: var(--db-surface);
        border: 1px solid var(--db-border);
        border-radius: var(--db-radius);
        box-shadow: var(--db-shadow);
        padding: 1.5rem;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .db-panel-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        gap: 1rem;
    }

    .db-panel-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--db-text);
        margin: 0 0 .3rem;
        letter-spacing: -.01em;
    }

    .db-panel-subtitle {
        font-size: .8rem;
        color: var(--db-muted);
        margin: 0;
        line-height: 1.5;
    }

    .db-panel-chip {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        background: var(--db-accent-soft);
        color: var(--db-accent);
        font-size: .72rem;
        font-weight: 600;
        padding: .3rem .65rem;
        border-radius: 999px;
        white-space: nowrap;
    }

    .db-chart-wrap {
        flex: 1;
        position: relative;
        min-height: 270px;
        max-height: 300px;
    }

    .db-chart-footer {
        margin-top: 1rem;
        padding-top: .85rem;
        border-top: 1px solid var(--db-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .db-chart-footer-label {
        font-size: .8rem;
        color: var(--db-muted);
    }

    .db-chart-footer-value {
        font-size: .875rem;
        font-weight: 700;
        color: var(--db-text);
        font-family: var(--db-mono);
    }

    /* ─── Divider row ────────────────────────────────── */
    .db-divider {
        grid-column: span 12;
        border: none;
        border-top: 1px solid var(--db-border);
        margin: .25rem 0;
    }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 1399px) {
        .db-stat { grid-column: span 3; }
    }

    @media (max-width: 1199px) {
        .db-stat  { grid-column: span 4; }
        .db-panel { grid-column: span 12; }
    }

    @media (max-width: 767px) {
        .db-page  { padding: 1.25rem 1rem 2rem; }
        .db-stat  { grid-column: span 6; }
        .db-header { flex-direction: column; align-items: flex-start; gap: .75rem; }
    }

    @media (max-width: 479px) {
        .db-stat  { grid-column: span 12; }
    }

    /* ─── Entry animation ────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .db-stat-card,
    .db-panel {
        animation: fadeUp .45s ease both;
    }

    .db-stat:nth-child(1) .db-stat-card  { animation-delay: .05s; }
    .db-stat:nth-child(2) .db-stat-card  { animation-delay: .10s; }
    .db-stat:nth-child(3) .db-stat-card  { animation-delay: .15s; }
    .db-stat:nth-child(4) .db-stat-card  { animation-delay: .20s; }
    .db-stat:nth-child(5) .db-stat-card  { animation-delay: .25s; }
    .db-panel:nth-of-type(1)             { animation-delay: .30s; }
    .db-panel:nth-of-type(2)             { animation-delay: .38s; }
</style>
@endpush

@section('content')
<div class="db-page">

    {{-- ── Page Header ─────────────────────────────── --}}
    <div class="db-header">
        <div class="db-header-left">
            <h2>Dashboard</h2>
            <p>Sunucu ve uygulama altyapısına genel bakış</p>
        </div>
        <span class="db-badge-live">Güncel Veri</span>
    </div>

    {{-- ── Main Grid ────────────────────────────────── --}}
    <div class="db-grid">

        {{-- Stat: Toplam Uygulama --}}
        <div class="db-stat">
            <div class="db-stat-card" style="--stat-color:#2563eb; --stat-bg:#eff4ff;">
                <div class="db-stat-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                </div>
                <p class="db-stat-label">Toplam Uygulama</p>
                <span class="db-stat-value">{{ $applicationCount }}</span>
            </div>
        </div>

        {{-- Stat: Toplam Sunucu --}}
        <div class="db-stat">
            <div class="db-stat-card" style="--stat-color:#7c3aed; --stat-bg:#f5f3ff;">
                <div class="db-stat-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="5" rx="2"/><rect x="2" y="10" width="20" height="5" rx="2"/><rect x="2" y="17" width="20" height="4" rx="2"/><line x1="6" y1="5.5" x2="6.01" y2="5.5"/><line x1="6" y1="12.5" x2="6.01" y2="12.5"/></svg>
                </div>
                <p class="db-stat-label">Toplam Sunucu</p>
                <span class="db-stat-value">{{ $serverCount }}</span>
            </div>
        </div>

        {{-- Stat: Test --}}
        <div class="db-stat">
            <div class="db-stat-card" style="--stat-color:#d97706; --stat-bg:#fffbeb;">
                <div class="db-stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                </div>
                <p class="db-stat-label">Test</p>
                <span class="db-stat-value">{{ $environmentCounts['Test'] ?? 0 }}</span>
            </div>
        </div>

        {{-- Stat: Pre-Prod --}}
        <div class="db-stat">
            <div class="db-stat-card" style="--stat-color:#0891b2; --stat-bg:#ecfeff;">
                <div class="db-stat-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <p class="db-stat-label">Pre-Prod</p>
                <span class="db-stat-value">{{ $environmentCounts['Pre-Prod'] ?? 0 }}</span>
            </div>
        </div>

        {{-- Stat: Prod --}}
        <div class="db-stat">
            <div class="db-stat-card" style="--stat-color:#16a34a; --stat-bg:#f0fdf4;">
                <div class="db-stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <p class="db-stat-label">Prod</p>
                <span class="db-stat-value">{{ $environmentCounts['Prod'] ?? 0 }}</span>
            </div>
        </div>

        {{-- spacer on large screens to fill last stat cell --}}
        {{-- intentionally empty: 5 stats × span-2 = span-10, last 2 cols stay empty for breathing room --}}

        <hr class="db-divider">

        {{-- Chart: Ortam Dağılımı --}}
        <section class="db-panel">
            <div class="db-panel-header">
                <div>
                    <h3 class="db-panel-title">Ortamlara Göre Sunucu Dağılımı</h3>
                    <p class="db-panel-subtitle">Test, Pre-Prod ve Prod ortamlarındaki aktif sunucu sayıları</p>
                </div>
                <span class="db-panel-chip">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21.21 15.89A10 10 0 118 2.83"/><path d="M22 12A10 10 0 0012 2v10z"/></svg>
                    Grafik
                </span>
            </div>
            <div class="db-chart-wrap">
                <canvas id="environmentPieChart" aria-label="Ortamlara göre sunucu dağılımı" role="img"></canvas>
            </div>
            <div class="db-chart-footer">
                <span class="db-chart-footer-label">Toplam Sunucu</span>
                <span class="db-chart-footer-value">{{ $environmentCounts->sum() }}</span>
            </div>
        </section>

        {{-- Chart: OS Dağılımı --}}
        <section class="db-panel">
            <div class="db-panel-header">
                <div>
                    <h3 class="db-panel-title">İşletim Sistemine Göre Sunucu Dağılımı</h3>
                    <p class="db-panel-subtitle">Veritabanındaki gerçek sunucu kayıtları baz alınarak hesaplanır</p>
                </div>
                <span class="db-panel-chip">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21.21 15.89A10 10 0 118 2.83"/><path d="M22 12A10 10 0 0012 2v10z"/></svg>
                    Grafik
                </span>
            </div>
            <div class="db-chart-wrap">
                <canvas id="operatingSystemPieChart" aria-label="İşletim sistemlerine göre sunucu dağılımı" role="img"></canvas>
            </div>
            <div class="db-chart-footer">
                <span class="db-chart-footer-label">Toplam Sunucu</span>
                <span class="db-chart-footer-value">{{ $operatingSystemCounts->sum() }}</span>
            </div>
        </section>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const palette = [
        '#2563eb', '#7c3aed', '#16a34a', '#d97706',
        '#0891b2', '#dc2626', '#f97316', '#6366f1',
        '#14b8a6', '#db2777',
    ];

    const createPieChart = (elementId, labels, values) => {
        const canvas = document.getElementById(elementId);
        if (!canvas || !labels.length) return;

        new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: labels.map((_, i) => palette[i % palette.length]),
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 10,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '62%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                            padding: 18,
                            font: { family: "'DM Sans', sans-serif", size: 12, weight: '500' },
                            color: '#374151',
                        },
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleFont: { family: "'DM Sans', sans-serif", size: 12, weight: '600' },
                        bodyFont:  { family: "'DM Sans', sans-serif", size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: (ctx) => {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct   = total ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return `  ${ctx.label}: ${ctx.raw} sunucu  (${pct}%)`;
                            },
                        },
                    },
                },
                animation: {
                    animateRotate: true,
                    duration: 700,
                    easing: 'easeOutQuart',
                },
            },
        });
    };

    createPieChart(
        'environmentPieChart',
        @json($environmentCounts->keys()->values()),
        @json($environmentCounts->values()->values()),
    );

    createPieChart(
        'operatingSystemPieChart',
        @json($operatingSystemCounts->keys()->values()),
        @json($operatingSystemCounts->values()->values()),
    );
</script>
@endpush