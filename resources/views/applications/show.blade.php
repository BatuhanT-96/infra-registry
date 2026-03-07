@extends('layouts.app')

@push('styles')
<style>
    .app-detail-page {
        --page-card-shadow: 0 14px 40px rgba(15, 23, 42, 0.08);
        --surface-border: #e2e8f0;
        --text-muted-custom: #64748b;
    }

    .app-detail-hero,
    .environment-block,
    .server-item {
        border: 1px solid var(--surface-border);
        border-radius: 1rem;
        background: #ffffff;
    }

    .app-detail-hero {
        box-shadow: var(--page-card-shadow);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .app-detail-title {
        font-size: clamp(1.6rem, 2vw, 2.2rem);
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .app-detail-description {
        color: var(--text-muted-custom);
        max-width: 68ch;
        line-height: 1.7;
    }

    .environment-block {
        height: 100%;
        padding: 1.2rem;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
    }

    .environment-header {
        border-bottom: 1px solid #eef2f7;
        padding-bottom: 0.9rem;
        margin-bottom: 1rem;
    }

    .environment-label {
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.01em;
        margin: 0;
    }

    .environment-count {
        font-size: 0.75rem;
        color: var(--text-muted-custom);
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .server-list {
        display: grid;
        gap: 0.9rem;
    }

    .server-item {
        padding: 1rem 1.1rem;
        box-shadow: 0 5px 14px rgba(15, 23, 42, 0.04);
    }

    .server-name {
        font-weight: 700;
        margin-bottom: 0.55rem;
        line-height: 1.35;
    }

    .server-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem 0.75rem;
        margin-bottom: 0.5rem;
    }

    .meta-pill {
        border-radius: 999px;
        padding: 0.24rem 0.62rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #334155;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .server-notes {
        color: var(--text-muted-custom);
        font-size: 0.92rem;
        line-height: 1.55;
        margin: 0;
    }

    .empty-state {
        border: 1px dashed #cbd5e1;
        border-radius: 0.85rem;
        background: #f8fafc;
        color: var(--text-muted-custom);
        text-align: center;
        padding: 1.15rem;
        margin: 0;
    }

    @media (max-width: 991.98px) {
        .app-detail-hero {
            padding: 1.5rem;
        }

        .environment-block {
            padding: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .app-detail-hero {
            padding: 1.2rem;
            margin-bottom: 1.25rem;
        }

        .server-item {
            padding: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<div class="app-detail-page">
    <section class="app-detail-hero">
        <div class="d-flex flex-column gap-3">
            <div>
                <p class="text-uppercase text-secondary fw-semibold small mb-2">Uygulama Detayı</p>
                <h1 class="app-detail-title mb-0">{{ $application->name }}</h1>
            </div>
            <p class="app-detail-description mb-0">
                {{ $application->description ?: 'Bu uygulama için açıklama bulunmuyor.' }}
            </p>
        </div>
    </section>

    <section class="row g-4">
        @foreach($environments as $environment)
            @php
                $servers = $groupedServers[$environment] ?? collect();
            @endphp
            <div class="col-12 col-md-6 col-xxl-4">
                <article class="environment-block">
                    <header class="environment-header d-flex justify-content-between align-items-center gap-2">
                        <h2 class="environment-label">{{ $environment }}</h2>
                        <span class="environment-count">{{ $servers->count() }} sunucu</span>
                    </header>

                    @if($servers->isNotEmpty())
                        <div class="server-list">
                            @foreach($servers as $server)
                                <section class="server-item">
                                    <h3 class="server-name h6">{{ $server->name }}</h3>
                                    <div class="server-meta">
                                        <span class="meta-pill">IP: {{ $server->ip_address }}</span>
                                        <span class="meta-pill">OS: {{ $server->operatingSystem->name }}</span>
                                    </div>
                                    <p class="server-notes">{{ $server->notes ?: 'Not bulunmuyor.' }}</p>
                                </section>
                            @endforeach
                        </div>
                    @else
                        <p class="empty-state">Bu ortam için sunucu eklenmemiş.</p>
                    @endif
                </article>
            </div>
        @endforeach
    </section>
</div>
@endsection
