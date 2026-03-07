@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    :root {
        --u-bg:          #f0f2f7;
        --u-surface:     #ffffff;
        --u-border:      #e4e8f0;
        --u-text:        #111827;
        --u-muted:       #6b7280;
        --u-subtle:      #9ca3af;
        --u-accent:      #2563eb;
        --u-accent-dark: #1d4ed8;
        --u-accent-soft: #eff4ff;
        --u-amber:       #d97706;
        --u-amber-soft:  #fffbeb;
        --u-red:         #dc2626;
        --u-red-soft:    #fef2f2;
        --u-purple:      #7c3aed;
        --u-purple-soft: #f5f3ff;
        --u-green:       #16a34a;
        --u-green-soft:  #f0fdf4;
        --u-radius:      14px;
        --u-radius-sm:   8px;
        --u-shadow-sm:   0 1px 3px rgba(0,0,0,.06);
        --u-shadow:      0 4px 16px rgba(15,23,42,.08), 0 1px 4px rgba(15,23,42,.04);
        --u-font:        'DM Sans', sans-serif;
        --u-mono:        'DM Mono', monospace;
    }

    .u-page {
        font-family: var(--u-font);
        background: var(--u-bg);
        min-height: 100vh;
        padding: 2rem 2.5rem 3rem;
        box-sizing: border-box;
    }

    /* Header */
    .u-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .u-header-left h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--u-text);
        margin: 0 0 .2rem;
        letter-spacing: -.02em;
    }

    .u-header-left p {
        font-size: .85rem;
        color: var(--u-muted);
        margin: 0;
    }

    .u-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: var(--u-accent);
        color: #fff;
        font-family: var(--u-font);
        font-size: .875rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: var(--u-radius-sm);
        border: none;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(37,99,235,.28);
        transition: background .18s, box-shadow .18s, transform .14s;
    }

    .u-btn-primary:hover {
        background: var(--u-accent-dark);
        box-shadow: 0 4px 14px rgba(37,99,235,.38);
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    .u-btn-primary svg {
        width: 15px; height: 15px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    /* Table card */
    .u-card {
        background: var(--u-surface);
        border: 1px solid var(--u-border);
        border-radius: var(--u-radius);
        box-shadow: var(--u-shadow);
        overflow: hidden;
        animation: fadeUp .4s ease both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .u-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .875rem;
    }

    .u-table thead {
        background: #f8fafc;
        border-bottom: 1px solid var(--u-border);
    }

    .u-table thead th {
        padding: .8rem 1.25rem;
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--u-muted);
        text-align: left;
        white-space: nowrap;
    }

    .u-table thead th:last-child { text-align: right; }

    .u-table tbody tr {
        border-bottom: 1px solid var(--u-border);
        transition: background .14s;
    }

    .u-table tbody tr:last-child { border-bottom: none; }
    .u-table tbody tr:hover { background: #f8fafc; }

    .u-table tbody td {
        padding: .95rem 1.25rem;
        vertical-align: middle;
        color: var(--u-text);
    }

    .u-table tbody td:last-child { text-align: right; }

    /* User cell */
    .u-user-cell {
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .u-avatar {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: .78rem; font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        font-family: var(--u-mono);
        text-transform: uppercase;
        background: var(--avatar-bg, #2563eb);
    }

    .u-user-name {
        font-weight: 600;
        color: var(--u-text);
        line-height: 1.3;
    }

    /* Username */
    .u-username {
        font-family: var(--u-mono);
        font-size: .8rem;
        color: #374151;
        background: var(--u-bg);
        border: 1px solid var(--u-border);
        border-radius: 5px;
        padding: .18rem .55rem;
        display: inline-block;
    }

    .u-username::before {
        content: '@';
        color: var(--u-subtle);
        margin-right: 1px;
    }

    /* Role badge */
    .u-role-badge {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .25rem .7rem;
        border-radius: 999px;
        font-size: .73rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .u-role-badge svg {
        width: 11px; height: 11px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
    }

    .u-role-badge.admin {
        background: var(--u-purple-soft);
        color: var(--u-purple);
        border: 1px solid #ddd6fe;
    }

    .u-role-badge.user {
        background: var(--u-accent-soft);
        color: var(--u-accent);
        border: 1px solid #c7d9fd;
    }

    .u-role-badge.default {
        background: var(--u-bg);
        color: var(--u-muted);
        border: 1px solid var(--u-border);
    }

    /* You badge */
    .u-you-badge {
        display: inline-flex;
        align-items: center;
        padding: .18rem .5rem;
        background: var(--u-green-soft);
        color: var(--u-green);
        border: 1px solid #bbf7d0;
        border-radius: 999px;
        font-size: .67rem;
        font-weight: 700;
        letter-spacing: .04em;
        margin-left: .4rem;
        vertical-align: middle;
    }

    /* Actions */
    .u-actions {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: .4rem;
    }

    .u-action-btn {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-family: var(--u-font);
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

    .u-action-btn:hover { transform: translateY(-1px); text-decoration: none; }

    .u-action-btn svg {
        width: 12px; height: 12px;
        stroke: currentColor; fill: none;
        stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
    }

    .u-action-btn.edit   { background: var(--u-amber-soft); color: var(--u-amber); border-color: #fde68a; }
    .u-action-btn.edit:hover { background: #fef3c7; border-color: var(--u-amber); color: var(--u-amber); }

    .u-action-btn.delete { background: var(--u-red-soft); color: var(--u-red); border-color: #fecaca; }
    .u-action-btn.delete:hover { background: #fee2e2; border-color: var(--u-red); color: var(--u-red); }

    .u-action-btn.disabled-self {
        background: var(--u-bg);
        color: var(--u-subtle);
        border-color: var(--u-border);
        cursor: not-allowed;
        opacity: .5;
        pointer-events: none;
    }

    /* Pagination */
    .u-pagination {
        margin-top: 1.25rem;
        display: flex;
        justify-content: flex-end;
    }

    .u-pagination .pagination {
        display: flex; gap: .3rem; list-style: none; margin: 0; padding: 0;
    }

    .u-pagination .page-item .page-link {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 34px; height: 34px; padding: 0 .6rem;
        font-family: var(--u-font); font-size: .825rem; font-weight: 500;
        color: var(--u-muted); background: var(--u-surface);
        border: 1px solid var(--u-border); border-radius: 7px;
        text-decoration: none; transition: all .15s;
    }

    .u-pagination .page-item .page-link:hover {
        background: var(--u-accent-soft); border-color: var(--u-accent); color: var(--u-accent);
    }

    .u-pagination .page-item.active .page-link {
        background: var(--u-accent); border-color: var(--u-accent); color: #fff;
        font-weight: 700; box-shadow: 0 2px 8px rgba(37,99,235,.28);
    }

    .u-pagination .page-item.disabled .page-link { opacity: .4; pointer-events: none; }

    @media (max-width: 767px) {
        .u-page { padding: 1.25rem 1rem 2rem; }
        .u-table thead th:nth-child(2),
        .u-table tbody td:nth-child(2) { display: none; }
        .u-pagination { justify-content: center; }
    }
</style>
@endpush

@section('content')
<div class="u-page">

    @php
        $avatarColors = ['#2563eb','#7c3aed','#0891b2','#16a34a','#d97706','#dc2626','#db2777','#0d9488'];
    @endphp

    <div class="u-header">
        <div class="u-header-left">
            <h2>Kullanıcı Yönetimi</h2>
            <p>Sisteme erişimi olan kullanıcıları görüntüle ve yönet</p>
        </div>
        <a class="u-btn-primary" href="{{ route('users.create') }}">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Yeni Kullanıcı
        </a>
    </div>

    <div class="u-card">
        <table class="u-table">
            <thead>
                <tr>
                    <th>Kullanıcı</th>
                    <th>Kullanıcı Adı</th>
                    <th>Rol</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                    @php
                        $color    = $avatarColors[$i % count($avatarColors)];
                        $initials = collect(explode(' ', $user->full_name))->map(fn($w) => mb_substr($w,0,1))->take(2)->implode('');
                        $roleName = strtolower($user->role->name ?? '');
                        $roleClass = str_contains($roleName, 'admin') ? 'admin' : (str_contains($roleName, 'kullanıcı') || str_contains($roleName, 'user') ? 'user' : 'default');
                        $isSelf   = auth()->id() === $user->id;
                    @endphp
                    <tr>
                        <td>
                            <div class="u-user-cell">
                                <div class="u-avatar" style="--avatar-bg:{{ $color }}">{{ $initials }}</div>
                                <span class="u-user-name">
                                    {{ $user->full_name }}
                                    @if($isSelf)
                                        <span class="u-you-badge">SEN</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td><span class="u-username">{{ $user->username }}</span></td>
                        <td>
                            <span class="u-role-badge {{ $roleClass }}">
                                @if($roleClass === 'admin')
                                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                @endif
                                {{ $user->role->name }}
                            </span>
                        </td>
                        <td>
                            <div class="u-actions">
                                <a class="u-action-btn edit" href="{{ route('users.edit', $user) }}">
                                    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Düzenle
                                </a>
                                @if(!$isSelf)
                                    <form
                                        method="POST"
                                        action="{{ route('users.destroy', $user) }}"
                                        style="display:inline;"
                                        onsubmit="return confirm('{{ $user->full_name }} adlı kullanıcıyı silmek istediğinize emin misiniz?')"
                                    >
                                        @csrf @method('DELETE')
                                        <button class="u-action-btn delete" type="submit">
                                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                            Sil
                                        </button>
                                    </form>
                                @else
                                    <span class="u-action-btn disabled-self">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                        Sil
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="u-pagination">
            {{ $users->links() }}
        </div>
    @endif

</div>
@endsection