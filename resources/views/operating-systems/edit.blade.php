@extends('layouts.app')

@section('content')
<h2 class="mb-3">İşletim Sistemi Düzenle</h2>
<div class="card p-3"><form method="POST" action="{{ route('operating-systems.update', $operatingSystem) }}">@method('PUT') @include('operating-systems.form')</form></div>
@endsection
