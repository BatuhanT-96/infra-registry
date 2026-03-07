@csrf

@if($errors->any())
    <div class="uf-alert">
        <div class="uf-alert-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="uf-alert-body">
            <p class="uf-alert-title">Lütfen aşağıdaki hataları düzeltin</p>
            <ul class="uf-alert-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="uf-fields">

    {{-- Full name --}}
    <div class="uf-field @error('full_name') uf-field--error @enderror">
        <label class="uf-label" for="field-fullname">
            Ad Soyad
            <span class="uf-required" aria-hidden="true">*</span>
        </label>
        <div class="uf-input-wrap">
            <span class="uf-input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </span>
            <input
                class="uf-input"
                id="field-fullname"
                type="text"
                name="full_name"
                value="{{ old('full_name', $user->full_name ?? '') }}"
                placeholder="Örn: Ahmet Yılmaz"
                required
                autocomplete="name"
            >
        </div>
        @error('full_name')
            <p class="uf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Username --}}
    <div class="uf-field @error('username') uf-field--error @enderror">
        <label class="uf-label" for="field-username">
            Kullanıcı Adı
            <span class="uf-required" aria-hidden="true">*</span>
        </label>
        <div class="uf-input-wrap">
            <span class="uf-input-icon uf-input-icon--at">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 006 0v-1a10 10 0 10-3.92 7.94"/></svg>
            </span>
            <input
                class="uf-input uf-mono-input"
                id="field-username"
                type="text"
                name="username"
                value="{{ old('username', $user->username ?? '') }}"
                placeholder="kullanici_adi"
                required
                autocomplete="username"
                autocapitalize="none"
            >
        </div>
        @error('username')
            <p class="uf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Role --}}
    <div class="uf-field @error('role_id') uf-field--error @enderror">
        <label class="uf-label" for="field-role">
            Rol
            <span class="uf-required" aria-hidden="true">*</span>
        </label>
        <div class="uf-select-wrap">
            <svg class="uf-select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <svg class="uf-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="uf-select" id="field-role" name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('role_id')
            <p class="uf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="uf-field @error('password') uf-field--error @enderror">
        <label class="uf-label" for="field-password">
            Şifre
            @if(!isset($user))
                <span class="uf-required" aria-hidden="true">*</span>
            @endif
        </label>
        @if(isset($user))
            <p class="uf-hint">Boş bırakılırsa mevcut şifre değişmez.</p>
        @endif
        <div class="uf-input-wrap">
            <span class="uf-input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            </span>
            <input
                class="uf-input"
                id="field-password"
                type="password"
                name="password"
                placeholder="{{ isset($user) ? '••••••••' : 'En az 8 karakter' }}"
                {{ isset($user) ? '' : 'required' }}
                autocomplete="{{ isset($user) ? 'new-password' : 'new-password' }}"
            >
            <button type="button" class="uf-eye-btn" onclick="togglePassword()" aria-label="Şifreyi göster/gizle">
                <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>
        @error('password')
            <p class="uf-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="uf-actions">
    <a class="uf-btn-secondary" href="javascript:history.back()">İptal</a>
    <button class="uf-btn-primary" type="submit">
        @if(($submitIcon ?? 'save') === 'plus')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        @endif
        {{ $submitLabel ?? 'Kaydet' }}
    </button>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('field-password');
    const icon  = document.getElementById('eye-icon');
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    icon.innerHTML = show
        ? '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}
</script>