@extends('layouts.app')
@section('content')
<h2>Sunucu Düzenle</h2>
<div class="card p-3"><form method="POST" action="{{ route('servers.update', $server) }}">@method('PUT') @include('servers.form')</form></div>
@endsection
