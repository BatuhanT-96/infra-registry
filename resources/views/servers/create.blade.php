@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
@include('servers.form_styles')
@endpush

@section('content')
<div class="sf-page">

    <a class="sf-back" href="{{ route('servers.index') }}">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Sunuculara Dön
    </a>

    <div class="sf-header">
        <div class="sf-header-icon" style="--icon-color:#2563eb; --icon-bg:#eff4ff; --icon-border:#c7d9fd;">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <div>
            <p class="sf-eyebrow">Sunucular</p>
            <h1 class="sf-title">Yeni Sunucu</h1>
            <p class="sf-subtitle">Sisteme yeni bir sunucu kaydı oluşturun.</p>
        </div>
    </div>

    <div class="sf-card">
        <form method="POST" action="{{ route('servers.store') }}">
            @include('servers.form', ['submitLabel' => 'Sunucuyu Oluştur', 'submitIcon' => 'plus'])
        </form>
    </div>

</div>
@endsection