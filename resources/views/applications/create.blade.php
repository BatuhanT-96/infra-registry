@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
@include('applications._form_styles')
@endpush

@section('content')
<div class="af-page">

    <a class="af-back" href="{{ route('applications.index') }}">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Uygulamalara Dön
    </a>

    <div class="af-header">
        <div class="af-header-icon" style="--icon-color:#2563eb; --icon-bg:#eff4ff; --icon-border:#c7d9fd;">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <div>
            <p class="af-eyebrow">Uygulamalar</p>
            <h1 class="af-title">Yeni Uygulama</h1>
            <p class="af-subtitle">Sisteme yeni bir uygulama kaydı oluşturun.</p>
        </div>
    </div>

    <div class="af-card">
        <form method="POST" action="{{ route('applications.store') }}">
            @include('applications.form', ['submitLabel' => 'Uygulamayı Oluştur', 'submitIcon' => 'plus'])
        </form>
    </div>

</div>
@endsection