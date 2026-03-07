@extends('layouts.app')

@section('content')
<h2 class="mb-3">Yeni İşletim Sistemi</h2>
<div class="card p-3"><form method="POST" action="{{ route('operating-systems.store') }}">@include('operating-systems.form')</form></div>
@endsection
