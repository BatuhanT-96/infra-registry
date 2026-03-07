@csrf
<div class="mb-3">
    <label class="form-label">Uygulama Adı</label>
    <input class="form-control" name="name" value="{{ old('name', $application->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Açıklama</label>
    <textarea class="form-control" name="description" rows="4">{{ old('description', $application->description ?? '') }}</textarea>
</div>
<button class="btn btn-primary">Kaydet</button>
