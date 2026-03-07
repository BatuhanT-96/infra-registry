@extends('layouts.app')
@section('content')
<h2>Yeni Sunucu</h2>
<div class="card p-3"><form method="POST" action="{{ route('servers.store') }}">@include('servers.form')</form></div>
@endsection
