@extends('layouts.app')

@section('content')
<h2>Uygulama Düzenle</h2>
<div class="card p-3">
    <form method="POST" action="{{ route('applications.update', $application) }}">
        @method('PUT')
        @include('applications.form')
    </form>
</div>
@endsection
