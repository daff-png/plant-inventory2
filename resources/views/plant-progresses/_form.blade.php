@csrf
<div class="mb-4">
    <label class="form-label" for="plant_id">Tanaman *</label>
    <select class="form-select @error('plant_id') is-invalid @enderror" name="plant_id" required>
        <option value="" disabled selected>Pilih Tanaman</option>
        @foreach($plants as $plant)
            <option value="{{ $plant->id }}" {{ (old('plant_id', $plantProgress->plant_id ?? request('plant_id')) == $plant->id) ? 'selected' : '' }}>
                {{ $plant->plant_name }} ({{ $plant->latin_name }})
            </option>
        @endforeach
    </select>
    @error('plant_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label" for="progress_type">Tipe Progres *</label>
    <select class="form-select @error('progress_type') is-invalid @enderror" name="progress_type" required>
        <option value="planting" {{ (old('progress_type', $plantProgress->progress_type ?? '') == 'planting') ? 'selected' : '' }}>Penanaman</option>
        <option value="growing" {{ (old('progress_type', $plantProgress->progress_type ?? '') == 'growing') ? 'selected' : '' }}>Pertumbuhan</option>
        <option value="harvesting" {{ (old('progress_type', $plantProgress->progress_type ?? '') == 'harvesting') ? 'selected' : '' }}>Panen</option>
    </select>
    @error('progress_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label" for="progress_date">Tanggal Progres *</label>
    <div data-mdb-input-init class="form-outline">
        <input type="date" id="progress_date" name="progress_date" class="form-control @error('progress_date') is-invalid @enderror" 
               value="{{ old('progress_date', $plantProgress->progress_date ?? '') ? \Carbon\Carbon::parse(old('progress_date', $plantProgress->progress_date ?? ''))->format('Y-m-d') : date('Y-m-d') }}" required />
    </div>
    @error('progress_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label class="form-label" for="description">Deskripsi / Catatan *</label>
    <div data-mdb-input-init class="form-outline">
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $plantProgress->description ?? '') }}</textarea>
    </div>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('plant-progresses.index') }}" class="btn btn-light" data-mdb-ripple-init>Batal</a>
</div>