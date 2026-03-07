@extends('layouts.app')
@section('content')
<h2>Kullanıcı Düzenle</h2>
<div class="card p-3"><form method="POST" action="{{ route('users.update', $user) }}">@method('PUT') @include('users.form')</form></div>
@endsection
