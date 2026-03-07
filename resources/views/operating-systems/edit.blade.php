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
        <div class="osf-header-icon" style="--icon-color:#d97706; --icon-bg:#fffbeb; --icon-border:#fde68a;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <div>
            <p class="osf-eyebrow">İşletim Sistemi Düzenle</p>
            <h1 class="osf-title">{{ $operatingSystem->name }}</h1>
            <p class="osf-subtitle">İşletim sistemi bilgilerini güncelleyin.</p>
        </div>
    </div>

    <div class="osf-card">
        <form method="POST" action="{{ route('operating-systems.update', $operatingSystem) }}">
            @method('PUT')
            @include('operating-systems.form', ['submitLabel' => 'Değişiklikleri Kaydet', 'submitIcon' => 'save'])
        </form>
    </div>

</div>
@endsection