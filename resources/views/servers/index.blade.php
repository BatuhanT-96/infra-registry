@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Sunucular</h2>
    @if(auth()->user()->isAdmin())
        <a class="btn btn-primary" href="{{ route('servers.create') }}">Yeni Sunucu</a>
    @endif
</div>

@php
    $sortDirectionIcon = $direction === 'asc' ? '↑' : '↓';

    $sortableColumns = [
        'name' => 'Server Name',
        'application' => 'Application',
        'ip_address' => 'IP Address',
        'operating_system' => 'Operating System',
        'environment' => 'Environment',
    ];
@endphp

<form class="row g-2 mb-3" method="GET">
    <div class="col-md-4">
        <input class="form-control" name="q" value="{{ $search }}" placeholder="Sunucu, uygulama, OS, IP veya nota göre ara">
    </div>

    <div class="col-md-3">
        <select name="application_id" class="form-select">
            <option value="">Tüm Uygulamalar</option>
            @foreach($applications as $application)
                <option value="{{ $application->id }}" @selected((string) $applicationId === (string) $application->id)>{{ $application->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="environment" class="form-select">
            <option value="">Tüm Ortamlar</option>
            @foreach($environments as $env)
                <option value="{{ $env }}" @selected($environment === $env)>{{ $env }}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="sort" value="{{ $sort }}">
    <input type="hidden" name="direction" value="{{ $direction }}">

    <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Filtrele</button>
    </div>
</form>

<div class="card">
<table class="table mb-0">
    <thead>
        <tr>
            @foreach($sortableColumns as $columnKey => $columnLabel)
                @php
                    $isActiveSort = $sort === $columnKey;
                    $nextDirection = $isActiveSort && $direction === 'asc' ? 'desc' : 'asc';
                @endphp
                <th>
                    <a
                        class="text-decoration-none text-dark d-inline-flex align-items-center gap-1"
                        href="{{ route('servers.index', array_merge(request()->query(), ['sort' => $columnKey, 'direction' => $nextDirection])) }}"
                    >
                        <span>{{ $columnLabel }}</span>
                        @if($isActiveSort)
                            <span aria-label="sorted {{ $direction }}">{{ $sortDirectionIcon }}</span>
                        @endif
                    </a>
                </th>
            @endforeach
            <th>Notes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($servers as $server)
        <tr>
            <td>{{ $server->name }}</td>
            <td>{{ $server->application->name }}</td>
            <td>{{ $server->ip_address }}</td>
            <td>{{ $server->operatingSystem->name }}</td>
            <td>{{ $server->environment_type }}</td>
            <td>{{ $server->notes }}</td>
            <td>
            @if(auth()->user()->isAdmin())
                <a class="btn btn-sm btn-warning" href="{{ route('servers.edit', $server) }}">Düzenle</a>
                <form method="POST" action="{{ route('servers.destroy', $server) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Sil</button></form>
            @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Kayıt yok.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-3">{{ $servers->links() }}</div>
@endsection
