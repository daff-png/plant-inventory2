@extends('layouts.app')

@section('content')
<h2>Detail Progres</h2>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Tanaman: <a href="{{ route('plants.show', $plantProgress->plant_id) }}">{{ $plantProgress->plant->plant_name ?? 'N/A' }}</a></h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <strong>Tipe Progres:</strong> 
                <span>{{ ucfirst($plantProgress->progress_type) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Tanggal:</strong> 
                <span>{{ $plantProgress->progress_date->format('d F Y') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Dicatat Oleh:</strong> 
                <span>{{ $plantProgress->user->name ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
                <strong>Deskripsi:</strong>
                <p class="mt-2">{{ $plantProgress->description }}</p>
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <a href="{{ route('plant-progresses.index') }}" class="btn btn-light" data-mdb-ripple-init>
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Progres
        </a>
    </div>
</div>
@endsection