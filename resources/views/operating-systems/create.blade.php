@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
@include('operating-systems.form_styles')
@endpush

@section('content')
<div class="osf-page">

    <a class="osf-back" href="{{ route('operating-systems.index') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        İşletim Sistemlerine Dön
    </a>

    <div class="osf-header">
        <div class="osf-header-icon" style="--icon-color:#2563eb; --icon-bg:#eff4ff; --icon-border:#c7d9fd;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <div>
            <p class="osf-eyebrow">İşletim Sistemleri</p>
            <h1 class="osf-title">Yeni İşletim Sistemi</h1>
            <p class="osf-subtitle">Sisteme yeni bir işletim sistemi kaydı ekleyin.</p>
        </div>
    </div>

    <div class="osf-card">
        <form method="POST" action="{{ route('operating-systems.store') }}">
            @include('operating-systems.form', ['submitLabel' => 'Oluştur', 'submitIcon' => 'plus'])
        </form>
    </div>

</div>
@endsection