@extends('layouts.app')

@section('content')
<h2>{{ $application->name }}</h2>
<p class="text-muted">{{ $application->description }}</p>
<div class="row g-3">
@foreach($environments as $environment)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header fw-bold">{{ $environment }}</div>
            <div class="card-body">
                @forelse(($groupedServers[$environment] ?? collect()) as $server)
                    <div class="border rounded p-2 mb-2">
                        <div class="fw-bold">{{ $server->name }}</div>
                        <small>{{ $server->ip_address }} | {{ $server->operatingSystem->name }}</small>
                        <div>{{ $server->notes }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">Sunucu yok</p>
                @endforelse
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
