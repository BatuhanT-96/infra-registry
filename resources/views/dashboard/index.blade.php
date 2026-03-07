@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>
<div class="row g-3">
    <div class="col-md-3"><div class="card card-stat p-3"><h6>Toplam Uygulama</h6><h3>{{ $applicationCount }}</h3></div></div>
    <div class="col-md-3"><div class="card card-stat p-3"><h6>Toplam Sunucu</h6><h3>{{ $serverCount }}</h3></div></div>
    @foreach(['Test', 'Pre-Prod', 'Prod'] as $env)
        <div class="col-md-2"><div class="card card-stat p-3"><h6>{{ $env }}</h6><h3>{{ $environmentCounts[$env] ?? 0 }}</h3></div></div>
    @endforeach
</div>
@endsection
