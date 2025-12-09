@csrf
<div class="mb-4">
    <label class="form-label" for="plant_id">Tanaman *</label>
    <select class="form-select @error('plant_id') is-invalid @enderror" name="plant_id" 
        {{ isset($plantTip) ? 'disabled' : 'required' }}>
        <option value="" disabled selected>Pilih Tanaman...</option>
        @foreach($plants as $plant)
            <option value="{{ $plant->id }}" 
                {{ (old('plant_id', $plantTip->plant_id ?? request('plant_id')) == $plant->id) ? 'selected' : '' }}>
                {{ $plant->plant_name }}
            </option>
        @endforeach
    </select>
    @if(isset($plantTip))
        <input type="hidden" name="plant_id" value="{{ $plantTip->plant_id }}" />
        <small class="text-muted">Tanaman tidak dapat diubah saat mengedit.</small>
    @endif
    @error('plant_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <textarea class="form-control @error('watering_tips') is-invalid @enderror" id="watering_tips" name="watering_tips" rows="4">{{ old('watering_tips', $plantTip->watering_tips ?? '') }}</textarea>
    <label class="form-label" for="watering_tips">Tips Penyiraman</label>
    @error('watering_tips') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <textarea class="form-control @error('lighting_tips') is-invalid @enderror" id="lighting_tips" name="lighting_tips" rows="4">{{ old('lighting_tips', $plantTip->lighting_tips ?? '') }}</textarea>
    <label class="form-label" for="lighting_tips">Tips Pencahayaan</label>
    @error('lighting_tips') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <textarea class="form-control @error('soil_media') is-invalid @enderror" id="soil_media" name="soil_media" rows="4">{{ old('soil_media', $plantTip->soil_media ?? '') }}</textarea>
    <label class="form-label" for="soil_media">Tips Media Tanam</label>
    @error('soil_media') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mt-4 border-top pt-4">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('plant-tips.index') }}" class="btn btn-light" data-mdb-ripple-init>Batal</a>
</div>