@csrf
<div class="mb-3"><label class="form-label">Ad Soyad</label><input class="form-control" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" required></div>
<div class="mb-3"><label class="form-label">Kullanıcı Adı</label><input class="form-control" name="username" value="{{ old('username', $user->username ?? '') }}" required></div>
<div class="mb-3"><label class="form-label">Rol</label><select class="form-select" name="role_id" required>@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '')==$role->id)>{{ $role->name }}</option>@endforeach</select></div>
<div class="mb-3"><label class="form-label">Şifre {{ isset($user) ? '(Boş bırakılırsa değişmez)' : '' }}</label><input type="password" class="form-control" name="password" {{ isset($user) ? '' : 'required' }}></div>
<button class="btn btn-primary">Kaydet</button>
