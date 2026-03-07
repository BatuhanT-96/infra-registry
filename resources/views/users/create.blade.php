@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
@include('users.form_styles')
@endpush

@section('content')
<div class="uf-page">

    <a class="uf-back" href="{{ route('users.index') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kullanıcılara Dön
    </a>

    <div class="uf-header">
        <div class="uf-header-icon" style="--icon-color:#2563eb; --icon-bg:#eff4ff; --icon-border:#c7d9fd;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        </div>
        <div>
            <p class="uf-eyebrow">Kullanıcı Yönetimi</p>
            <h1 class="uf-title">Yeni Kullanıcı</h1>
            <p class="uf-subtitle">Sisteme erişim için yeni bir kullanıcı hesabı oluşturun.</p>
        </div>
    </div>

    <div class="uf-card">
        <form method="POST" action="{{ route('users.store') }}">
            @include('users.form', ['submitLabel' => 'Kullanıcı Oluştur', 'submitIcon' => 'plus'])
        </form>
    </div>

</div>
@endsection