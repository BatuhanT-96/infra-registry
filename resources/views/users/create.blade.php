@extends('layouts.app')
@section('content')
<h2>Yeni Kullanıcı</h2>
<div class="card p-3"><form method="POST" action="{{ route('users.store') }}">@include('users.form')</form></div>
@endsection
