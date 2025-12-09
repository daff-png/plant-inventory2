@csrf
<div class="row">
    <div class="col-md-6">
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="plant_name" name="plant_name" class="form-control @error('plant_name') is-invalid @enderror" value="{{ old('plant_name', $plant->plant_name ?? '') }}" required />
            <label class="form-label" for="plant_name">Nama Tanaman *</label>
            @error('plant_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="latin_name" name="latin_name" class="form-control" value="{{ old('latin_name', $plant->latin_name ?? '') }}" />
            <label class="form-label" for="latin_name">Nama Latin</label>
        </div>

        <select class="form-select mb-4 @error('category_id') is-invalid @enderror" name="category_id" required>
            <option value="" disabled selected>Pilih Kategori Tanaman *</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (old('category_id', $plant->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $plant->location ?? '') }}" />
            <label class="form-label" for="location">Lokasi Penempatan</label>
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="barcode" name="barcode" class="form-control @error('barcode') is-invalid @enderror" value="{{ old('barcode', $plant->barcode ?? '') }}" />
            <label class="form-label" for="barcode">Barcode</label>
            @error('barcode') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label" for="photo">Foto Tanaman</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" />
            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @if(isset($plant) && $plant->photo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $plant->photo) }}" alt="Foto" height="100">
            </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label" for="planting_date">Tanggal Tanam</label>
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="date" id="planting_date" name="planting_date" class="form-control" value="{{ old('planting_date', $plant->planting_date ?? '') ? \Carbon\Carbon::parse(old('planting_date', $plant->planting_date ?? ''))->format('Y-m-d') : '' }}" />
        </div>

        <label class_="" for="condition">Kondisi *</label>
        <select class="form-select mb-4 @error('condition') is-invalid @enderror" name="condition" required>
            <option value="healthy" {{ (old('condition', $plant->condition ?? '') == 'healthy') ? 'selected' : '' }}>Sehat</option>
            <option value="sick" {{ (old('condition', $plant->condition ?? '') == 'sick') ? 'selected' : '' }}>Sakit</option>
            <option value="dead" {{ (old('condition', $plant->condition ?? '') == 'dead') ? 'selected' : '' }}>Mati</option>
        </select>
        @error('condition') <div class="invalid-feedback">{{ $message }}</div> @enderror
        
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $plant->stock ?? 0) }}" required />
            <label class="form-label" for="stock">Stok *</label>
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $plant->description ?? '') }}</textarea>
            <label class="form-label" for="description">Deskripsi</label>
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" id="health_benefits" name="health_benefits" rows="3">{{ old('health_benefits', $plant->health_benefits ?? '') }}</textarea>
            <label class="form-label" for="health_benefits">Manfaat Kesehatan</label>
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" id="cultural_benefits" name="cultural_benefits" rows="3">{{ old('cultural_benefits', $plant->cultural_benefits ?? '') }}</textarea>
            <label class="form-label" for="cultural_benefits">Manfaat Kultural</label>
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
            <textarea class="form-control" id="habitat" name="habitat" rows="3">{{ old('habitat', $plant->habitat ?? '') }}</textarea>
            <label class="form-label" for="habitat">Habitat Asli</label>
        </div>
    </div>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('plants.index') }}" class="btn btn-light" data-mdb-ripple-init>Batal</a>
</div>