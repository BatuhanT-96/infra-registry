@csrf

@if($errors->any())
    <div class="osf-alert">
        <div class="osf-alert-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="osf-alert-body">
            <p class="osf-alert-title">Lütfen aşağıdaki hataları düzeltin</p>
            <ul class="osf-alert-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="osf-fields">

    {{-- Name --}}
    <div class="osf-field @error('name') osf-field--error @enderror">
        <label class="osf-label" for="field-name">
            İşletim Sistemi Adı
            <span class="osf-required" aria-hidden="true">*</span>
        </label>
        <div class="osf-input-wrap">
            <span class="osf-input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
            </span>
            <input
                class="osf-input"
                id="field-name"
                type="text"
                name="name"
                value="{{ old('name', $operatingSystem->name ?? '') }}"
                placeholder="Örn: Ubuntu 22.04 LTS"
                required
                autocomplete="off"
            >
        </div>
        @error('name')
            <p class="osf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Active toggle --}}
    <div class="osf-field">
        <label class="osf-label">Durum</label>
        <p class="osf-hint">Pasif işletim sistemleri yeni sunuculara atanamaz.</p>
        <label class="osf-toggle" for="is_active">
            <input
                class="osf-toggle-input"
                type="checkbox"
                id="is_active"
                name="is_active"
                value="1"
                @checked(old('is_active', $operatingSystem->is_active ?? true))
            >
            <span class="osf-toggle-track">
                <span class="osf-toggle-thumb"></span>
            </span>
            <span class="osf-toggle-label">Aktif</span>
        </label>
    </div>

</div>

<div class="osf-actions">
    <a class="osf-btn-secondary" href="javascript:history.back()">İptal</a>
    <button class="osf-btn-primary" type="submit">
        @if(($submitIcon ?? 'save') === 'plus')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        @endif
        {{ $submitLabel ?? 'Kaydet' }}
    </button>
</div>