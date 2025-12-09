@extends('layouts.app')

@section('content')
<h2>Detail Kategori</h2>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">{{ $plantCategory->category_name }}</h5>
    </div>
    <div class="card-body">
        <strong>Deskripsi:</strong>
        <p class="mt-2">{{ $plantCategory->description ?? 'Tidak ada deskripsi.' }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('plant-categories.index') }}" class="btn btn-light" data-mdb-ripple-init>
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kategori
        </a>
    </div>
</div>
@endsection