@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    /* ─── Tokens ─────────────────────────────────────── */
    :root {
        --sv-bg:          #f0f2f7;
        --sv-surface:     #ffffff;
        --sv-border:      #e4e8f0;
        --sv-text:        #111827;
        --sv-muted:       #6b7280;
        --sv-subtle:      #9ca3af;
        --sv-accent:      #2563eb;
        --sv-accent-dark: #1d4ed8;
        --sv-accent-soft: #eff4ff;
        --sv-amber:       #d97706;
        --sv-amber-soft:  #fffbeb;
        --sv-red:         #dc2626;
        --sv-red-soft:    #fef2f2;
        --sv-radius:      14px;
        --sv-radius-sm:   8px;
        --sv-shadow-sm:   0 1px 3px rgba(0,0,0,.06);
        --sv-shadow:      0 4px 16px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --sv-font:        'DM Sans', sans-serif;
        --sv-mono:        'DM Mono', monospace;
    }

    .sv-page {
        font-family: var(--sv-font);
        background: var(--sv-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3rem;
        box-sizing: border-box;
    }

    /* ─── Header ─────────────────────────────────────── */
    .sv-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .sv-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--sv-text);
        margin: 0 0 .2rem;
        letter-spacing: -.02em;
    }

    .sv-header-left p {
        font-size: .85rem;
        color: var(--sv-muted);
        margin: 0;
    }

    .sv-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: var(--sv-accent);
        color: #fff;
        font-family: var(--sv-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--sv-radius-sm);
        border: none;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .sv-btn-primary:hover {
        background: var(--sv-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    .sv-btn-primary svg {
        width: 15px; height: 15px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Filter Bar ─────────────────────────────────── */
    .sv-filters {
        background: var(--sv-surface);
        border: 1px solid var(--sv-border);
        border-radius: var(--sv-radius);
        box-shadow: var(--sv-shadow-sm);
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
    }

    .sv-filter-group {
        flex: 1;
        min-width: 160px;
        position: relative;
    }

    .sv-filter-group svg {
        position: absolute;
        left: .8rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px; height: 14px;
        stroke: var(--sv-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round;
        pointer-events: none;
    }

    .sv-input, .sv-select {
        width: 100%;
        font-family: var(--sv-font);
        font-size: .85rem;
        color: var(--sv-text);
        background: var(--sv-bg);
        border: 1px solid var(--sv-border);
        border-radius: var(--sv-radius-sm);
        outline: none;
        transition: border-color .18s, box-shadow .18s, background .18s;
        box-sizing: border-box;
        height: 40px;
        padding: 0 .85rem 0 2.3rem;
        appearance: none;
        -webkit-appearance: none;
    }

    .sv-input::placeholder { color: #9ca3af; }

    .sv-input:focus, .sv-select:focus {
        border-color: var(--sv-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    .sv-select-wrap {
        flex: 1;
        min-width: 150px;
        position: relative;
    }

    .sv-select-wrap svg.icon {
        position: absolute;
        left: .8rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px; height: 14px;
        stroke: var(--sv-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round;
        pointer-events: none;
    }

    .sv-select-wrap svg.chevron {
        position: absolute;
        right: .75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 14px; height: 14px;
        stroke: var(--sv-subtle); fill: none;
        stroke-width: 2.5; stroke-linecap: round;
        pointer-events: none;
    }

    .sv-filter-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-family: var(--sv-font);
        font-size: .85rem;
        font-weight: 600;
        padding: 0 1.1rem;
        height: 40px;
        border-radius: var(--sv-radius-sm);
        border: 1px solid var(--sv-border);
        background: var(--sv-bg);
        color: var(--sv-text);
        cursor: pointer;
        white-space: nowrap;
        transition: background .15s, border-color .15s, color .15s;
    }

    .sv-filter-btn:hover {
        background: var(--sv-accent-soft);
        border-color: var(--sv-accent);
        color: var(--sv-accent);
    }

    .sv-filter-btn svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2; stroke-linecap: round;
    }

    /* ─── Table Card ─────────────────────────────────── */
    .sv-card {
        background: var(--sv-surface);
        border: 1px solid var(--sv-border);
        border-radius: var(--sv-radius);
        box-shadow: var(--sv-shadow);
        overflow: hidden;
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── Table ──────────────────────────────────────── */
    .sv-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .855rem;
    }

    .sv-table thead {
        background: #f8fafc;
        border-bottom: 1px solid var(--sv-border);
    }

    .sv-table thead th {
        padding: .8rem 1.1rem;
        text-align: left;
        white-space: nowrap;
    }

    .sv-table thead th:last-child { text-align: right; }

    .sv-sort-link {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--sv-muted);
        text-decoration: none;
        transition: color .15s;
    }

    .sv-sort-link:hover { color: var(--sv-accent); text-decoration: none; }
    .sv-sort-link.active { color: var(--sv-accent); }

    .sv-sort-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px; height: 16px;
        background: var(--sv-accent-soft);
        border-radius: 4px;
    }

    .sv-sort-icon svg {
        width: 10px; height: 10px;
        stroke: var(--sv-accent); fill: none;
        stroke-width: 3; stroke-linecap: round; stroke-linejoin: round;
    }

    .sv-th-label {
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--sv-muted);
    }

    .sv-table tbody tr {
        border-bottom: 1px solid var(--sv-border);
        transition: background .14s;
    }

    .sv-table tbody tr:last-child { border-bottom: none; }
    .sv-table tbody tr:hover { background: #f8fafc; }

    .sv-table tbody td {
        padding: .9rem 1.1rem;
        color: var(--sv-text);
        vertical-align: middle;
    }

    .sv-table tbody td:last-child { text-align: right; }

    /* Name cell */
    .sv-server-name {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-weight: 600;
    }

    .sv-avatar {
        width: 30px; height: 30px;
        border-radius: 7px;
        background: var(--sv-accent-soft);
        border: 1px solid #c7d9fd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .72rem;
        font-weight: 700;
        color: var(--sv-accent);
        text-transform: uppercase;
        flex-shrink: 0;
        font-family: var(--sv-mono);
    }

    /* Mono fields */
    .sv-mono {
        font-family: var(--sv-mono);
        font-size: .8rem;
        color: #374151;
        background: var(--sv-bg);
        border: 1px solid var(--sv-border);
        border-radius: 5px;
        padding: .18rem .55rem;
        display: inline-block;
        white-space: nowrap;
    }

    /* App link */
    .sv-app-link {
        color: var(--sv-accent);
        font-weight: 500;
        text-decoration: none;
        font-size: .85rem;
    }

    .sv-app-link:hover { text-decoration: underline; }

    /* Environment badge */
    .sv-env-badge {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .22rem .65rem;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .sv-env-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: .8;
    }

    .sv-env-badge.env-test     { background: #fffbeb; color: #d97706; }
    .sv-env-badge.env-preprod  { background: #ecfeff; color: #0891b2; }
    .sv-env-badge.env-prod     { background: #f0fdf4; color: #16a34a; }
    .sv-env-badge.env-default  { background: var(--sv-accent-soft); color: var(--sv-accent); }

    /* Notes */
    .sv-notes {
        color: var(--sv-muted);
        font-size: .8rem;
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    .sv-notes-empty { color: var(--sv-subtle); font-style: italic; }

    /* ─── Action Buttons ─────────────────────────────── */
    .sv-actions {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: .35rem;
    }

    .sv-action-btn {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-family: var(--sv-font);
        font-size: .75rem;
        font-weight: 600;
        padding: .35rem .7rem;
        border-radius: 6px;
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
        white-space: nowrap;
        transition: background .15s, border-color .15s, transform .12s;
    }

    .sv-action-btn:hover { transform: translateY(-1px); text-decoration: none; }

    .sv-action-btn svg {
        width: 12px; height: 12px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
    }

    .sv-action-btn.edit   { background: var(--sv-amber-soft); color: var(--sv-amber); border-color: #fde68a; }
    .sv-action-btn.edit:hover { background: #fef3c7; border-color: var(--sv-amber); color: var(--sv-amber); }

    .sv-action-btn.delete { background: var(--sv-red-soft); color: var(--sv-red); border-color: #fecaca; }
    .sv-action-btn.delete:hover { background: #fee2e2; border-color: var(--sv-red); color: var(--sv-red); }

    /* ─── Empty State ────────────────────────────────── */
    .sv-empty {
        padding: 3.5rem 1.5rem;
        text-align: center;
    }

    .sv-empty-icon {
        width: 48px; height: 48px;
        background: var(--sv-bg);
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .85rem;
    }

    .sv-empty-icon svg {
        width: 22px; height: 22px;
        stroke: var(--sv-subtle); fill: none;
        stroke-width: 1.8; stroke-linecap: round;
    }

    .sv-empty strong { display: block; font-size: .95rem; color: var(--sv-text); font-weight: 600; margin-bottom: .3rem; }
    .sv-empty p { color: var(--sv-muted); font-size: .85rem; margin: 0; }

    /* ─── Pagination ─────────────────────────────────── */
    .sv-pagination {
        margin-top: 1.25rem;
        display: flex;
        justify-content: flex-end;
    }

    .sv-pagination .pagination {
        display: flex; gap: .3rem; list-style: none; margin: 0; padding: 0;
    }

    .sv-pagination .page-item .page-link {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 34px; height: 34px; padding: 0 .6rem;
        font-family: var(--sv-font); font-size: .825rem; font-weight: 500;
        color: var(--sv-muted); background: var(--sv-surface);
        border: 1px solid var(--sv-border); border-radius: 7px;
        text-decoration: none; transition: all .15s;
    }

    .sv-pagination .page-item .page-link:hover {
        background: var(--sv-accent-soft); border-color: var(--sv-accent); color: var(--sv-accent);
    }

    .sv-pagination .page-item.active .page-link {
        background: var(--sv-accent); border-color: var(--sv-accent); color: #fff;
        font-weight: 700; box-shadow: 0 2px 8px rgba(37,99,235,.28);
    }

    .sv-pagination .page-item.disabled .page-link { opacity: .4; pointer-events: none; }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 1199px) {
        .sv-table th:nth-child(6),
        .sv-table td:nth-child(6) { display: none; }
    }

    @media (max-width: 991px) {
        .sv-table th:nth-child(4),
        .sv-table td:nth-child(4) { display: none; }
    }

    @media (max-width: 767px) {
        .sv-page { padding: 1.25rem 1rem 2rem; }
        .sv-table th:nth-child(3),
        .sv-table td:nth-child(3) { display: none; }
        .sv-pagination { justify-content: center; }
    }
</style>
@endpush

@section('content')
<div class="sv-page">

    {{-- ── Header ───────────────────────────────────── --}}
    <div class="sv-header">
        <div class="sv-header-left">
            <h2>Sunucular</h2>
            <p>Tüm sunucuları filtrele, sırala ve yönet</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a class="sv-btn-primary" href="{{ route('servers.create') }}">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Yeni Sunucu
            </a>
        @endif
    </div>

    {{-- ── Filters ──────────────────────────────────── --}}
    @php
        $sortableColumns = [
            'name'             => 'Sunucu Adı',
            'application'      => 'Uygulama',
            'ip_address'       => 'IP Adresi',
            'operating_system' => 'İşletim Sistemi',
            'environment'      => 'Ortam',
        ];
    @endphp

    <form class="sv-filters" method="GET">
        {{-- Search --}}
        <div class="sv-filter-group" style="flex:2; min-width:200px;">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                class="sv-input"
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Sunucu, uygulama, OS, IP veya nota göre ara…"
                autocomplete="off"
            >
        </div>

        {{-- Application filter --}}
        <div class="sv-select-wrap">
            <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            <svg class="chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="sv-select" name="application_id">
                <option value="">Tüm Uygulamalar</option>
                @foreach($applications as $application)
                    <option value="{{ $application->id }}" @selected((string) $applicationId === (string) $application->id)>
                        {{ $application->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Environment filter --}}
        <div class="sv-select-wrap" style="min-width:130px; flex: 0 1 160px;">
            <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <svg class="chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="sv-select" name="environment">
                <option value="">Tüm Ortamlar</option>
                @foreach($environments as $env)
                    <option value="{{ $env }}" @selected($environment === $env)>{{ $env }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="sort"      value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <button class="sv-filter-btn" type="submit">
            <svg viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
            Filtrele
        </button>
    </form>

    {{-- ── Table ────────────────────────────────────── --}}
    <div class="sv-card">
        <table class="sv-table">
            <thead>
                <tr>
                    @foreach($sortableColumns as $columnKey => $columnLabel)
                        @php
                            $isActive     = $sort === $columnKey;
                            $nextDir      = ($isActive && $direction === 'asc') ? 'desc' : 'asc';
                            $arrowUp      = $direction === 'asc';
                        @endphp
                        <th>
                            <a
                                class="sv-sort-link {{ $isActive ? 'active' : '' }}"
                                href="{{ route('servers.index', array_merge(request()->query(), ['sort' => $columnKey, 'direction' => $nextDir])) }}"
                            >
                                {{ $columnLabel }}
                                @if($isActive)
                                    <span class="sv-sort-icon">
                                        <svg viewBox="0 0 24 24">
                                            @if($arrowUp)
                                                <polyline points="18 15 12 9 6 15"/>
                                            @else
                                                <polyline points="6 9 12 15 18 9"/>
                                            @endif
                                        </svg>
                                    </span>
                                @endif
                            </a>
                        </th>
                    @endforeach
                    <th><span class="sv-th-label">Notlar</span></th>
                    <th><span class="sv-th-label">İşlemler</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($servers as $server)
                    @php
                        $envClass = match($server->environment_type) {
                            'Test'     => 'env-test',
                            'Pre-Prod' => 'env-preprod',
                            'Prod'     => 'env-prod',
                            default    => 'env-default',
                        };
                    @endphp
                    <tr>
                        <td>
                            <div class="sv-server-name">
                                <div class="sv-avatar">{{ mb_substr($server->name, 0, 2) }}</div>
                                {{ $server->name }}
                            </div>
                        </td>
                        <td>
                            <a class="sv-app-link" href="{{ route('applications.show', $server->application) }}">
                                {{ $server->application->name }}
                            </a>
                        </td>
                        <td><span class="sv-mono">{{ $server->ip_address }}</span></td>
                        <td>{{ $server->operatingSystem->name }}</td>
                        <td><span class="sv-env-badge {{ $envClass }}">{{ $server->environment_type }}</span></td>
                        <td>
                            @if($server->notes)
                                <span class="sv-notes" title="{{ $server->notes }}">{{ $server->notes }}</span>
                            @else
                                <span class="sv-notes sv-notes-empty">—</span>
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->isAdmin())
                                <div class="sv-actions">
                                    <a class="sv-action-btn edit" href="{{ route('servers.edit', $server) }}">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Düzenle
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('servers.destroy', $server) }}"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bu sunucuyu silmek istediğinize emin misiniz?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="sv-action-btn delete" type="submit">
                                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                            Sil
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="sv-notes sv-notes-empty">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="sv-empty">
                                <div class="sv-empty-icon">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="5" rx="2"/><rect x="2" y="10" width="20" height="5" rx="2"/><rect x="2" y="17" width="20" height="4" rx="2"/><line x1="6" y1="5.5" x2="6.01" y2="5.5"/></svg>
                                </div>
                                <strong>Sunucu bulunamadı</strong>
                                <p>Filtre kriterlerinizi değiştirin veya yeni bir sunucu ekleyin.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── Pagination ───────────────────────────────── --}}
    @if($servers->hasPages())
        <div class="sv-pagination">
            {{ $servers->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection