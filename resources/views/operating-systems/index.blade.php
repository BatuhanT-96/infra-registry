@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>İşletim Sistemleri</h2>
    <a class="btn btn-primary" href="{{ route('operating-systems.create') }}">Yeni İşletim Sistemi</a>
</div>
<form class="row g-2 mb-3" method="GET">
    <div class="col-md-4"><input class="form-control" name="q" value="{{ $search }}" placeholder="İşletim sistemi adına göre ara"></div>
    <div class="col-md-2"><button class="btn btn-outline-secondary">Ara</button></div>
</form>
<div class="card">
    <table class="table mb-0">
        <thead><tr><th>Ad</th><th>Durum</th><th>İşlem</th></tr></thead>
        <tbody>
        @forelse($operatingSystems as $operatingSystem)
            <tr>
                <td>{{ $operatingSystem->name }}</td>
                <td>
                    @if($operatingSystem->is_active)
                        <span class="badge text-bg-success">Aktif</span>
                    @else
                        <span class="badge text-bg-secondary">Pasif</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-sm btn-warning" href="{{ route('operating-systems.edit', $operatingSystem) }}">Düzenle</a>
                    <form method="POST" action="{{ route('operating-systems.destroy', $operatingSystem) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Sil</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">Kayıt yok.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $operatingSystems->links() }}</div>
@endsection
