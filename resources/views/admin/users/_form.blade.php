@csrf
<div data-mdb-input-init class="form-outline mb-4">
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? '') }}" required />
    <label class="form-label" for="name">Nama *</label>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? '') }}" required />
    <label class="form-label" for="email">Email *</label>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<label class_="" for="role">Role *</label>
<select class="form-select mb-4 @error('role') is-invalid @enderror" name="role" required>
    <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>User</option>
    <option value="staff" {{ (old('role', $user->role ?? '') == 'staff') ? 'selected' : '' }}>Staff</option>
    <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
</select>
@error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror

<hr>
<p class="text-muted">{{ isset($user) ? 'Isi password jika ingin mengubahnya.' : 'Buat password untuk user baru.' }}</p>

<div data-mdb-input-init class="form-outline mb-4">
    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ isset($user) ? '' : 'required' }} />
    <label class="form-label" for="password">Password {{ isset($user) ? '' : '*' }}</label>
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div data-mdb-input-init class="form-outline mb-4">
    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }} />
    <label class="form-label" for="password_confirmation">Konfirmasi Password {{ isset($user) ? '' : '*' }}</label>
</div>


<div class="mt-4">
    <button type="submit" class="btn btn-primary" data-mdb-ripple-init>{{ $submitButtonText ?? 'Simpan' }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-light" data-mdb-ripple-init>Batal</a>
</div>