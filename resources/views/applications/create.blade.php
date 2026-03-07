@extends('layouts.app')

@section('content')
<h2>Yeni Uygulama</h2>
<div class="card p-3">
    <form method="POST" action="{{ route('applications.store') }}">
        @include('applications.form')
    </form>
</div>
@endsection
