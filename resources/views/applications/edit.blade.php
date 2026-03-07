@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
@include('applications._form_styles')
@endpush

@section('content')
<div class="af-page">

    <a class="af-back" href="{{ route('applications.show', $application) }}">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Uygulamaya Dön
    </a>

    <div class="af-header">
        <div class="af-header-icon" style="--icon-color:#d97706; --icon-bg:#fffbeb; --icon-border:#fde68a;">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
        <div>
            <p class="af-eyebrow">Uygulama Düzenle</p>
            <h1 class="af-title">{{ $application->name }}</h1>
            <p class="af-subtitle">Uygulama bilgilerini güncelleyin.</p>
        </div>
    </div>

    <div class="af-card">
        <form method="POST" action="{{ route('applications.update', $application) }}">
            @method('PUT')
            @include('applications.form', ['submitLabel' => 'Değişiklikleri Kaydet', 'submitIcon' => 'save'])
        </form>
    </div>

</div>
@endsection