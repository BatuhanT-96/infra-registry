@csrf
<div class="mb-3">
    <label class="form-label">Uygulama</label>
    <select name="application_id" class="form-select" required>
        @foreach($applications as $application)
            <option value="{{ $application->id }}" @selected(old('application_id', $server->application_id ?? '')==$application->id)>{{ $application->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3"><label class="form-label">Sunucu Adı</label><input class="form-control" name="name" value="{{ old('name', $server->name ?? '') }}" required></div>
<div class="mb-3"><label class="form-label">IP Adresi</label><input class="form-control" name="ip_address" value="{{ old('ip_address', $server->ip_address ?? '') }}" required></div>
<div class="mb-3"><label class="form-label">İşletim Sistemi</label><input class="form-control" name="operating_system" value="{{ old('operating_system', $server->operating_system ?? '') }}" required></div>
<div class="mb-3">
    <label class="form-label">Ortam Tipi</label>
    <select name="environment_type" class="form-select" required>
        @foreach($environments as $environment)
            <option value="{{ $environment }}" @selected(old('environment_type', $server->environment_type ?? '')===$environment)>{{ $environment }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3"><label class="form-label">Açıklama / Not</label><textarea class="form-control" name="notes">{{ old('notes', $server->notes ?? '') }}</textarea></div>
<button class="btn btn-primary">Kaydet</button>
