@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    /* ─── Tokens ─────────────────────────────────────── */
    :root {
        --ap-bg:          #f0f2f7;
        --ap-surface:     #ffffff;
        --ap-border:      #e4e8f0;
        --ap-text:        #111827;
        --ap-muted:       #6b7280;
        --ap-accent:      #2563eb;
        --ap-accent-soft: #eff4ff;
        --ap-accent-dark: #1d4ed8;
        --ap-green:       #16a34a;
        --ap-green-soft:  #f0fdf4;
        --ap-amber:       #d97706;
        --ap-amber-soft:  #fffbeb;
        --ap-red:         #dc2626;
        --ap-red-soft:    #fef2f2;
        --ap-radius:      14px;
        --ap-radius-sm:   8px;
        --ap-shadow-sm:   0 1px 3px rgba(0,0,0,.06);
        --ap-shadow:      0 4px 16px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --ap-font:        'DM Sans', sans-serif;
        --ap-mono:        'DM Mono', monospace;
    }

    /* ─── Page ───────────────────────────────────────── */
    .ap-page {
        font-family: var(--ap-font);
        background: var(--ap-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3rem;
        box-sizing: border-box;
    }

    /* ─── Page Header ────────────────────────────────── */
    .ap-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .ap-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--ap-text);
        margin: 0 0 .2rem;
        letter-spacing: -.02em;
    }

    .ap-header-left p {
        font-size: .85rem;
        color: var(--ap-muted);
        margin: 0;
    }

    /* ─── Primary Button ─────────────────────────────── */
    .ap-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: var(--ap-accent);
        color: #fff;
        font-family: var(--ap-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--ap-radius-sm);
        border: none;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(37,99,235,.30);
        transition: background .18s, box-shadow .18s, transform .15s;
    }

    .ap-btn-primary:hover {
        background: var(--ap-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.40);
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    .ap-btn-primary svg {
        width: 15px; height: 15px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── Search Bar ─────────────────────────────────── */
    .ap-search-wrap {
        background: var(--ap-surface);
        border: 1px solid var(--ap-border);
        border-radius: var(--ap-radius);
        box-shadow: var(--ap-shadow-sm);
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
    }

    .ap-search-field {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .ap-search-field svg {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        width: 15px; height: 15px;
        stroke: var(--ap-muted); fill: none;
        stroke-width: 2; stroke-linecap: round;
        pointer-events: none;
    }

    .ap-search-input {
        width: 100%;
        padding: .55rem .9rem .55rem 2.4rem;
        font-family: var(--ap-font);
        font-size: .875rem;
        color: var(--ap-text);
        background: var(--ap-bg);
        border: 1px solid var(--ap-border);
        border-radius: var(--ap-radius-sm);
        outline: none;
        transition: border-color .18s, box-shadow .18s;
        box-sizing: border-box;
    }

    .ap-search-input::placeholder { color: #9ca3af; }

    .ap-search-input:focus {
        border-color: var(--ap-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    .ap-search-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: var(--ap-bg);
        color: var(--ap-text);
        font-family: var(--ap-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .55rem 1.1rem;
        border: 1px solid var(--ap-border);
        border-radius: var(--ap-radius-sm);
        cursor: pointer;
        transition: background .15s, border-color .15s;
        white-space: nowrap;
    }

    .ap-search-btn:hover {
        background: var(--ap-accent-soft);
        border-color: var(--ap-accent);
        color: var(--ap-accent);
    }

    /* ─── Table Card ─────────────────────────────────── */
    .ap-card {
        background: var(--ap-surface);
        border: 1px solid var(--ap-border);
        border-radius: var(--ap-radius);
        box-shadow: var(--ap-shadow);
        overflow: hidden;
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── Table ──────────────────────────────────────── */
    .ap-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }

    .ap-table thead {
        background: #f8fafc;
        border-bottom: 1px solid var(--ap-border);
    }

    .ap-table thead th {
        padding: .85rem 1.25rem;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--ap-muted);
        text-align: left;
        white-space: nowrap;
    }

    .ap-table thead th:last-child {
        text-align: right;
    }

    .ap-table tbody tr {
        border-bottom: 1px solid var(--ap-border);
        transition: background .15s;
    }

    .ap-table tbody tr:last-child {
        border-bottom: none;
    }

    .ap-table tbody tr:hover {
        background: #f8fafc;
    }

    .ap-table tbody td {
        padding: 1rem 1.25rem;
        color: var(--ap-text);
        vertical-align: middle;
    }

    .ap-table tbody td:last-child {
        text-align: right;
    }

    /* Name cell */
    .ap-app-name {
        font-weight: 600;
        color: var(--ap-text);
        display: flex;
        align-items: center;
        gap: .65rem;
    }

    .ap-app-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--ap-accent-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: .8rem;
        font-weight: 700;
        color: var(--ap-accent);
        text-transform: uppercase;
    }

    /* Description cell */
    .ap-desc {
        color: var(--ap-muted);
        max-width: 340px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ─── Action Buttons ─────────────────────────────── */
    .ap-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .4rem;
        flex-wrap: nowrap;
    }

    .ap-action-btn {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-family: var(--ap-font);
        font-size: .78rem;
        font-weight: 600;
        padding: .38rem .75rem;
        border-radius: 6px;
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
        white-space: nowrap;
        transition: background .15s, border-color .15s, transform .12s;
    }

    .ap-action-btn:hover { transform: translateY(-1px); text-decoration: none; }

    .ap-action-btn svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
    }

    /* Detail */
    .ap-action-btn.detail {
        background: var(--ap-accent-soft);
        color: var(--ap-accent);
        border-color: #c7d9fd;
    }
    .ap-action-btn.detail:hover {
        background: #dbeafe;
        border-color: var(--ap-accent);
        color: var(--ap-accent);
    }

    /* Edit */
    .ap-action-btn.edit {
        background: var(--ap-amber-soft);
        color: var(--ap-amber);
        border-color: #fde68a;
    }
    .ap-action-btn.edit:hover {
        background: #fef3c7;
        border-color: var(--ap-amber);
        color: var(--ap-amber);
    }

    /* Delete */
    .ap-action-btn.delete {
        background: var(--ap-red-soft);
        color: var(--ap-red);
        border-color: #fecaca;
    }
    .ap-action-btn.delete:hover {
        background: #fee2e2;
        border-color: var(--ap-red);
        color: var(--ap-red);
    }

    /* ─── Empty State ────────────────────────────────── */
    .ap-empty {
        padding: 3.5rem 1.5rem;
        text-align: center;
    }

    .ap-empty-icon {
        width: 52px; height: 52px;
        background: var(--ap-bg);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem;
    }

    .ap-empty-icon svg {
        width: 24px; height: 24px;
        stroke: var(--ap-muted); fill: none;
        stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
    }

    .ap-empty p {
        color: var(--ap-muted);
        font-size: .9rem;
        margin: 0;
    }

    .ap-empty strong {
        display: block;
        color: var(--ap-text);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: .3rem;
    }

    /* ─── Pagination ─────────────────────────────────── */
    .ap-pagination {
        margin-top: 1.25rem;
        display: flex;
        justify-content: flex-end;
    }

    /* Override Laravel pagination to match theme */
    .ap-pagination nav { display: flex; }

    .ap-pagination .pagination {
        display: flex;
        gap: .3rem;
        list-style: none;
        margin: 0; padding: 0;
    }

    .ap-pagination .page-item .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 .6rem;
        font-family: var(--ap-font);
        font-size: .825rem;
        font-weight: 500;
        color: var(--ap-muted);
        background: var(--ap-surface);
        border: 1px solid var(--ap-border);
        border-radius: 7px;
        text-decoration: none;
        transition: all .15s;
    }

    .ap-pagination .page-item .page-link:hover {
        background: var(--ap-accent-soft);
        border-color: var(--ap-accent);
        color: var(--ap-accent);
    }

    .ap-pagination .page-item.active .page-link {
        background: var(--ap-accent);
        border-color: var(--ap-accent);
        color: #fff;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(37,99,235,.30);
    }

    .ap-pagination .page-item.disabled .page-link {
        opacity: .45;
        pointer-events: none;
    }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 767px) {
        .ap-page { padding: 1.25rem 1rem 2rem; }
        .ap-desc { display: none; }
        .ap-table thead th:nth-child(2) { display: none; }
        .ap-table tbody td:nth-child(2) { display: none; }
        .ap-pagination { justify-content: center; }
    }
</style>
@endpush

@section('content')
<div class="ap-page">

    {{-- ── Header ───────────────────────────────────── --}}
    <div class="ap-header">
        <div class="ap-header-left">
            <h2>Uygulamalar</h2>
            <p>Kayıtlı tüm uygulamaları görüntüle ve yönet</p>
        </div>
        @if(auth()->user()->isAdmin())
            <a class="ap-btn-primary" href="{{ route('applications.create') }}">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Yeni Uygulama
            </a>
        @endif
    </div>

    {{-- ── Search ───────────────────────────────────── --}}
    <form class="ap-search-wrap" method="GET">
        <div class="ap-search-field">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                class="ap-search-input"
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="Uygulama adına göre ara…"
                autocomplete="off"
            >
        </div>
        <button class="ap-search-btn" type="submit">
            Ara
        </button>
    </form>

    {{-- ── Table Card ───────────────────────────────── --}}
    <div class="ap-card">
        <table class="ap-table">
            <thead>
                <tr>
                    <th>Uygulama Adı</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>
                            <div class="ap-app-name">
                                <div class="ap-app-avatar">
                                    {{ mb_substr($application->name, 0, 2) }}
                                </div>
                                {{ $application->name }}
                            </div>
                        </td>
                        <td>
                            <span class="ap-desc" title="{{ $application->description }}">
                                {{ $application->description ?: '—' }}
                            </span>
                        </td>
                        <td>
                            <div class="ap-actions">
                                <a class="ap-action-btn detail" href="{{ route('applications.show', $application) }}">
                                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Detay
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <a class="ap-action-btn edit" href="{{ route('applications.edit', $application) }}">
                                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Düzenle
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('applications.destroy', $application) }}"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bu uygulamayı silmek istediğinize emin misiniz?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="ap-action-btn delete" type="submit">
                                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                            Sil
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="ap-empty">
                                <div class="ap-empty-icon">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                </div>
                                <strong>Uygulama bulunamadı</strong>
                                <p>Arama kriterlerinizi değiştirin veya yeni bir uygulama ekleyin.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── Pagination ───────────────────────────────── --}}
    @if($applications->hasPages())
        <div class="ap-pagination">
            {{ $applications->links() }}
        </div>
    @endif

</div>
@endsection