@csrf
<div class="mb-3">
    <label class="form-label">İşletim Sistemi Adı</label>
    <input class="form-control" name="name" value="{{ old('name', $operatingSystem->name ?? '') }}" required>
</div>
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $operatingSystem->is_active ?? true))>
    <label class="form-check-label" for="is_active">Aktif</label>
</div>
<button class="btn btn-primary">Kaydet</button>
