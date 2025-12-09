<div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="category_name" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name', $plantCategory->category_name ?? '') }}" required />
    <label class="form-label" for="category_name">Nama Kategori *</label>
    @error('category_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $plantCategory->description ?? '') }}</textarea>
    <label class="form-label" for="description">Deskripsi</label>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('plant-categories.index') }}" class="btn btn-light" data-mdb-ripple-init>Batal</a>
</div>