@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Uygulamalar</h2>
    @if(auth()->user()->isAdmin())
        <a class="btn btn-primary" href="{{ route('applications.create') }}">Yeni Uygulama</a>
    @endif
</div>
<form class="row g-2 mb-3" method="GET">
    <div class="col-md-4">
        <input class="form-control" name="q" value="{{ $search }}" placeholder="Uygulama adına göre ara">
    </div>
    <div class="col-md-2"><button class="btn btn-outline-secondary">Ara</button></div>
</form>
<div class="card">
<table class="table mb-0">
    <thead><tr><th>Ad</th><th>Açıklama</th><th>İşlem</th></tr></thead>
    <tbody>
    @forelse($applications as $application)
        <tr>
            <td>{{ $application->name }}</td>
            <td>{{ $application->description }}</td>
            <td>
                <a class="btn btn-sm btn-info" href="{{ route('applications.show', $application) }}">Detay</a>
                @if(auth()->user()->isAdmin())
                    <a class="btn btn-sm btn-warning" href="{{ route('applications.edit', $application) }}">Düzenle</a>
                    <form method="POST" action="{{ route('applications.destroy', $application) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf @method('DELETE')<button class="btn btn-sm btn-danger">Sil</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="3" class="text-center">Kayıt yok.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="mt-3">{{ $applications->links() }}</div>
@endsection
