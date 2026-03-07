@csrf

{{-- ── Validation Errors ──────────────────────────── --}}
@if($errors->any())
    <div class="sf-alert">
        <div class="sf-alert-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="sf-alert-body">
            <p class="sf-alert-title">Lütfen aşağıdaki hataları düzeltin</p>
            <ul class="sf-alert-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- ── Fields Grid ────────────────────────────────── --}}
<div class="sf-fields">

    {{-- Application --}}
    <div class="sf-field sf-field--full @error('application_id') sf-field--error @enderror">
        <label class="sf-label" for="field-app">
            Uygulama
            <span class="sf-required" aria-hidden="true">*</span>
        </label>
        <div class="sf-select-wrap">
            <svg class="sf-select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            <svg class="sf-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="sf-select" id="field-app" name="application_id" required>
                <option value="" disabled @selected(!old('application_id', $server->application_id ?? null))>Uygulama seçin…</option>
                @foreach($applications as $application)
                    <option value="{{ $application->id }}" @selected(old('application_id', $server->application_id ?? '') == $application->id)>
                        {{ $application->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('application_id')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Server Name --}}
    <div class="sf-field @error('name') sf-field--error @enderror">
        <label class="sf-label" for="field-name">
            Sunucu Adı
            <span class="sf-required" aria-hidden="true">*</span>
        </label>
        <div class="sf-input-wrap">
            <span class="sf-input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="5" rx="2"/><rect x="2" y="10" width="20" height="5" rx="2"/><rect x="2" y="17" width="20" height="4" rx="2"/><line x1="6" y1="5.5" x2="6.01" y2="5.5"/></svg>
            </span>
            <input
                class="sf-input"
                id="field-name"
                type="text"
                name="name"
                value="{{ old('name', $server->name ?? '') }}"
                placeholder="Örn: web-prod-01"
                required
                autocomplete="off"
            >
        </div>
        @error('name')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- IP Address --}}
    <div class="sf-field @error('ip_address') sf-field--error @enderror">
        <label class="sf-label" for="field-ip">
            IP Adresi
            <span class="sf-required" aria-hidden="true">*</span>
        </label>
        <div class="sf-input-wrap">
            <span class="sf-input-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            </span>
            <input
                class="sf-input sf-mono-input"
                id="field-ip"
                type="text"
                name="ip_address"
                value="{{ old('ip_address', $server->ip_address ?? '') }}"
                placeholder="192.168.1.1"
                required
                autocomplete="off"
            >
        </div>
        @error('ip_address')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Operating System --}}
    <div class="sf-field @error('operating_system_id') sf-field--error @enderror">
        <label class="sf-label" for="field-os">
            İşletim Sistemi
            <span class="sf-required" aria-hidden="true">*</span>
        </label>
        <div class="sf-select-wrap">
            <svg class="sf-select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            <svg class="sf-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="sf-select" id="field-os" name="operating_system_id" required>
                <option value="" disabled @selected(!old('operating_system_id', $server->operating_system_id ?? null))>İşletim sistemi seçin…</option>
                @foreach($operatingSystems as $operatingSystem)
                    <option
                        value="{{ $operatingSystem->id }}"
                        @selected((string) old('operating_system_id', $server->operating_system_id ?? '') === (string) $operatingSystem->id)
                    >
                        {{ $operatingSystem->name }}
                        @if(!$operatingSystem->is_active) (Pasif) @endif
                    </option>
                @endforeach
            </select>
        </div>
        @error('operating_system_id')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Environment --}}
    <div class="sf-field @error('environment_type') sf-field--error @enderror">
        <label class="sf-label" for="field-env">
            Ortam Tipi
            <span class="sf-required" aria-hidden="true">*</span>
        </label>
        <div class="sf-select-wrap">
            <svg class="sf-select-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <svg class="sf-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            <select class="sf-select" id="field-env" name="environment_type" required>
                <option value="" disabled @selected(!old('environment_type', $server->environment_type ?? null))>Ortam seçin…</option>
                @foreach($environments as $environment)
                    <option value="{{ $environment }}" @selected(old('environment_type', $server->environment_type ?? '') === $environment)>
                        {{ $environment }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('environment_type')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Notes --}}
    <div class="sf-field sf-field--full @error('notes') sf-field--error @enderror">
        <label class="sf-label" for="field-notes">Açıklama / Not</label>
        <p class="sf-hint">Sunucu hakkında ek bilgi, özel konfigürasyon veya hatırlatmalar.</p>
        <textarea
            class="sf-textarea"
            id="field-notes"
            name="notes"
            rows="4"
            placeholder="İsteğe bağlı not ekleyin…"
        >{{ old('notes', $server->notes ?? '') }}</textarea>
        @error('notes')
            <p class="sf-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>

{{-- ── Actions ─────────────────────────────────────── --}}
<div class="sf-actions">
    <a class="sf-btn-secondary" href="javascript:history.back()">İptal</a>
    <button class="sf-btn-primary" type="submit">
        @if(($submitIcon ?? 'save') === 'plus')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        @endif
        {{ $submitLabel ?? 'Kaydet' }}
    </button>
</div>