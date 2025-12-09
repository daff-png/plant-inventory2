@extends('layouts.app')

@section('page-title', 'Detail Tip Perawatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-2-strong rounded-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Tip Perawatan untuk: <a href="{{ route('plants.show', $plantTip->plant_id) }}">{{ $plantTip->plant->plant_name ?? 'N/A' }}</a></h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong class="d-block"><i class="fas fa-tint me-2 text-primary"></i>Tips Penyiraman</strong>
                        <p class="text-muted mt-2">{{ $plantTip->watering_tips ?? '-' }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong class="d-block"><i class="fas fa-sun me-2 text-warning"></i>Tips Pencahayaan</strong>
                        <p class="text-muted mt-2">{{ $plantTip->lighting_tips ?? '-' }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong class="d-block"><i class="fas fa-seedling me-2 text-success"></i>Tips Media Tanam</strong>
                        <p class="text-muted mt-2">{{ $plantTip->soil_media ?? '-' }}</p>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('plant-tips.index') }}" class="btn btn-light" data-mdb-ripple-init>
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Tips
                </a>
            </div>
        </div>
    </div>
</div>
@endsection