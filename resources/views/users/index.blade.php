@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Kullanıcı Yönetimi</h2>
    <a class="btn btn-primary" href="{{ route('users.create') }}">Yeni Kullanıcı</a>
</div>
<div class="card">
<table class="table mb-0">
<thead><tr><th>Ad Soyad</th><th>Kullanıcı Adı</th><th>Rol</th><th>İşlem</th></tr></thead>
<tbody>
@foreach($users as $user)
<tr>
    <td>{{ $user->full_name }}</td><td>{{ $user->username }}</td><td>{{ $user->role->name }}</td>
    <td>
        <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user) }}">Düzenle</a>
        @if(auth()->id() !== $user->id)
        <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Sil</button></form>
        @endif
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
