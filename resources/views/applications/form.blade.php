@csrf

{{-- ── Validation Errors ──────────────────────────── --}}
@if($errors->any())
    <div class="af-alert">
        <div class="af-alert-icon">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="af-alert-body">
            <p class="af-alert-title">Lütfen aşağıdaki hataları düzeltin</p>
            <ul class="af-alert-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

{{-- ── Fields ─────────────────────────────────────── --}}
<div class="af-fields">

    <div class="af-field @error('name') af-field--error @enderror">
        <label class="af-label" for="field-name">
            Uygulama Adı
            <span class="af-required" aria-hidden="true">*</span>
        </label>
        <div class="af-input-wrap">
            <span class="af-input-icon">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            </span>
            <input
                class="af-input"
                id="field-name"
                type="text"
                name="name"
                value="{{ old('name', $application->name ?? '') }}"
                placeholder="Örn: Müşteri Portalı"
                required
                autocomplete="off"
            >
        </div>
        @error('name')
            <p class="af-field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="af-field @error('description') af-field--error @enderror">
        <label class="af-label" for="field-desc">
            Açıklama
        </label>
        <p class="af-hint">Uygulamanın amacını ve kapsamını kısaca açıklayın.</p>
        <textarea
            class="af-textarea"
            id="field-desc"
            name="description"
            rows="5"
            placeholder="Bu uygulama hakkında kısa bir açıklama yazın…"
        >{{ old('description', $application->description ?? '') }}</textarea>
        @error('description')
            <p class="af-field-error">{{ $message }}</p>
        @enderror
    </div>

</div>

{{-- ── Actions ─────────────────────────────────────── --}}
<div class="af-actions">
    <a class="af-btn-secondary" href="javascript:history.back()">İptal</a>
    <button class="af-btn-primary" type="submit">
        @if(($submitIcon ?? 'save') === 'plus')
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        @else
            <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        @endif
        {{ $submitLabel ?? 'Kaydet' }}
    </button>
</div>