@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    :root {
        --os-bg:          #f0f2f7;
        --os-surface:     #ffffff;
        --os-border:      #e4e8f0;
        --os-text:        #111827;
        --os-muted:       #6b7280;
        --os-subtle:      #9ca3af;
        --os-accent:      #2563eb;
        --os-accent-dark: #1d4ed8;
        --os-accent-soft: #eff4ff;
        --os-green:       #16a34a;
        --os-green-soft:  #f0fdf4;
        --os-green-border:#bbf7d0;
        --os-amber:       #d97706;
        --os-amber-soft:  #fffbeb;
        --os-red:         #dc2626;
        --os-red-soft:    #fef2f2;
        --os-radius:      14px;
        --os-radius-sm:   8px;
        --os-shadow-sm:   0 1px 3px rgba(0,0,0,.06);
        --os-shadow:      0 4px 16px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --os-font:        'DM Sans', sans-serif;
        --os-mono:        'DM Mono', monospace;
    }

    .os-page {
        font-family: var(--os-font);
        background: var(--os-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3rem;
        box-sizing: border-box;
    }

    /* Header */
    .os-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .os-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--os-text);
        margin: 0 0 .2rem;
        letter-spacing: -.02em;
    }

    .os-header-left p {
        font-size: .85rem;
        color: var(--os-muted);
        margin: 0;
    }

    .os-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: var(--os-accent);
        color: #fff;
        font-family: var(--os-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--os-radius-sm);
        border: none;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .os-btn-primary:hover {
        background: var(--os-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    .os-btn-primary svg {
        width: 15px; height: 15px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* Search */
    .os-search {
        background: var(--os-surface);
        border: 1px solid var(--os-border);
        border-radius: var(--os-radius);
        box-shadow: var(--os-shadow-sm);
        padding: .9rem 1.1rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .os-search-field {
        flex: 1;
        max-width: 380px;
        position: relative;
    }

    .os-search-field svg {
        position: absolute;
        left: .8rem; top: 50%;
        transform: translateY(-50%);
        width: 14px; height: 14px;
        stroke: var(--os-subtle); fill: none;
        stroke-width: 2; stroke-linecap: round;
        pointer-events: none;
    }

    .os-search-input {
        width: 100%;
        font-family: var(--os-font);
        font-size: .855rem;
        color: var(--os-text);
        background: var(--os-bg);
        border: 1px solid var(--os-border);
        border-radius: var(--os-radius-sm);
        outline: none;
        padding: .55rem .9rem .55rem 2.35rem;
        height: 40px;
        box-sizing: border-box;
        transition: border-color .18s, box-shadow .18s, background .18s;
    }

    .os-search-input::placeholder { color: #9ca3af; }

    .os-search-input:focus {
        border-color: var(--os-accent);
        box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        background: #fff;
    }

    .os-search-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-family: var(--os-font);
        font-size: .855rem;
        font-weight: 600;
        padding: 0 1rem;
        height: 40px;
        border-radius: var(--os-radius-sm);
        border: 1px solid var(--os-border);
        background: var(--os-bg);
        color: var(--os-text);
        cursor: pointer;
        transition: background .15s, border-color .15s, color .15s;
        white-space: nowrap;
    }

    .os-search-btn:hover {
        background: var(--os-accent-soft);
        border-color: var(--os-accent);
        color: var(--os-accent);
    }

    /* Table card */
    .os-card {
        background: var(--os-surface);
        border: 1px solid var(--os-border);
        border-radius: var(--os-radius);
        box-shadow: var(--os-shadow);
        overflow: hidden;
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .os-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }

    .os-table thead {
        background: #f8fafc;
        border-bottom: 1px solid var(--os-border);
    }

    .os-table thead th {
        padding: .8rem 1.25rem;
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--os-muted);
        text-align: left;
        white-space: nowrap;
    }

    .os-table thead th:last-child { text-align: right; }

    .os-table tbody tr {
        border-bottom: 1px solid var(--os-border);
        transition: background .14s;
    }

    .os-table tbody tr:last-child { border-bottom: none; }
    .os-table tbody tr:hover { background: #f8fafc; }

    .os-table tbody td {
        padding: .95rem 1.25rem;
        vertical-align: middle;
        color: var(--os-text);
    }

    .os-table tbody td:last-child { text-align: right; }

    /* Name cell */
    .os-name-cell {
        display: flex;
        align-items: center;
        gap: .65rem;
        font-weight: 600;
    }

    .os-avatar {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: #f1f5f9;
        border: 1px solid var(--os-border);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .os-avatar svg {
        width: 15px; height: 15px;
        stroke: var(--os-muted); fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    /* Status badge */
    .os-badge {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .25rem .7rem;
        border-radius: 999px;
        font-size: .73rem;
        font-weight: 700;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .os-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: .8;
    }

    .os-badge.active {
        background: var(--os-green-soft);
        color: var(--os-green);
        border: 1px solid var(--os-green-border);
    }

    .os-badge.inactive {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    /* Action buttons */
    .os-actions {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: .4rem;
    }

    .os-action-btn {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-family: var(--os-font);
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

    .os-action-btn:hover { transform: translateY(-1px); text-decoration: none; }

    .os-action-btn svg {
        width: 12px; height: 12px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
    }

    .os-action-btn.edit   { background: var(--os-amber-soft); color: var(--os-amber); border-color: #fde68a; }
    .os-action-btn.edit:hover { background: #fef3c7; border-color: var(--os-amber); color: var(--os-amber); }

    .os-action-btn.delete { background: var(--os-red-soft); color: var(--os-red); border-color: #fecaca; }
    .os-action-btn.delete:hover { background: #fee2e2; border-color: var(--os-red); color: var(--os-red); }

    /* Empty */
    .os-empty {
        padding: 3.5rem 1.5rem;
        text-align: center;
    }

    .os-empty-icon {
        width: 48px; height: 48px;
        background: var(--os-bg);
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .85rem;
    }

    .os-empty-icon svg {
        width: 22px; height: 22px;
        stroke: var(--os-subtle); fill: none;
        stroke-width: 1.8; stroke-linecap: round;
    }

    .os-empty strong { display: block; font-size: .95rem; color: var(--os-text); font-weight: 600; margin-bottom: .3rem; }
    .os-empty p { color: var(--os-muted); font-size: .85rem; margin: 0; }

    /* Pagination */
    .os-pagination {
        margin-top: 1.25rem;
        display: flex;
        justify-content: flex-end;
    }

    .os-pagination .pagination {
        display: flex; gap: .3rem; list-style: none; margin: 0; padding: 0;
    }

    .os-pagination .page-item .page-link {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 34px; height: 34px; padding: 0 .6rem;
        font-family: var(--os-font); font-size: .825rem; font-weight: 500;
        color: var(--os-muted); background: var(--os-surface);
        border: 1px solid var(--os-border); border-radius: 7px;
        text-decoration: none; transition: all .15s;
    }

    .os-pagination .page-item .page-link:hover {
        background: var(--os-accent-soft); border-color: var(--os-accent); color: var(--os-accent);
    }

    .os-pagination .page-item.active .page-link {
        background: var(--os-accent); border-color: var(--os-accent); color: #fff;
        font-weight: 700; box-shadow: 0 2px 8px rgba(37,99,235,.28);
    }

    .os-pagination .page-item.disabled .page-link { opacity: .4; pointer-events: none; }

    @media (max-width: 767px) {
        .os-page { padding: 1.25rem 1rem 2rem; }
        .os-pagination { justify-content: center; }
    }
</style>
@endpush

@section('content')
<div class="os-page">

    <div class="os-header">
        <div class="os-header-left">
            <h2>İşletim Sistemleri</h2>
            <p>Sunuculara atanan işletim sistemlerini yönetin</p>
        </div>
        <a class="os-btn-primary" href="{{ route('operating-systems.create') }}">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Yeni İşletim Sistemi
        </a>
    </div>

    <form class="os-search" method="GET">
        <div class="os-search-field">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input
                class="os-search-input"
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="İşletim sistemi adına göre ara…"
                autocomplete="off"
            >
        </div>
        <button class="os-search-btn" type="submit">Ara</button>
    </form>

    <div class="os-card">
        <table class="os-table">
            <thead>
                <tr>
                    <th>İşletim Sistemi</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($operatingSystems as $operatingSystem)
                    <tr>
                        <td>
                            <div class="os-name-cell">
                                <div class="os-avatar">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                                </div>
                                {{ $operatingSystem->name }}
                            </div>
                        </td>
                        <td>
                            @if($operatingSystem->is_active)
                                <span class="os-badge active">Aktif</span>
                            @else
                                <span class="os-badge inactive">Pasif</span>
                            @endif
                        </td>
                        <td>
                            <div class="os-actions">
                                <a class="os-action-btn edit" href="{{ route('operating-systems.edit', $operatingSystem) }}">
                                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Düzenle
                                </a>
                                <form
                                    method="POST"
                                    action="{{ route('operating-systems.destroy', $operatingSystem) }}"
                                    style="display:inline;"
                                    onsubmit="return confirm('Bu işletim sistemini silmek istediğinize emin misiniz?')"
                                >
                                    @csrf @method('DELETE')
                                    <button class="os-action-btn delete" type="submit">
                                        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                        Sil
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="os-empty">
                                <div class="os-empty-icon">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
                                </div>
                                <strong>İşletim sistemi bulunamadı</strong>
                                <p>Arama kriterlerinizi değiştirin veya yeni bir kayıt ekleyin.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($operatingSystems->hasPages())
        <div class="os-pagination">
            {{ $operatingSystems->links() }}
        </div>
    @endif

</div>
@endsection