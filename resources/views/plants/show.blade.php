@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card">
            <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                <img src="{{ $plant->photo ? asset('storage/' . $plant->photo) : 'https://via.placeholder.com/400x300' }}" class="img-fluid" alt="Foto {{ $plant->plant_name }}" />
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $plant->plant_name }}</h3>
                <h5 class="text-muted">{{ $plant->latin_name }}</h5>
                <hr>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Kategori:</strong> 
                        <span>{{ $plant->category->category_name ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Kondisi:</strong>
                        @if($plant->condition == 'healthy')
                            <span class="badge badge-success">Sehat</span>
                        @elseif($plant->condition == 'sick')
                            <span class="badge badge-warning">Sakit</span>
                        @else
                            <span class="badge badge-danger">Mati</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Stok:</strong> 
                        <span>{{ $plant->stock }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Lokasi:</strong> 
                        <span>{{ $plant->location ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Tgl Tanam:</strong> 
                        <span>{{ $plant->planting_date ? $plant->planting_date->format('d M Y') : '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Barcode:</strong> 
                        <span>{{ $plant->barcode ?? '-' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Dicatat Oleh:</strong> 
                        <span>{{ $plant->user->name ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Update Terakhir:</strong> 
                        <span>{{ $plant->updated_at->format('d M Y, H:i') }}</span>
                    </li>
                </ul>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('plants.index') }}" class="btn btn-light" data-mdb-ripple-init>
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                    <a href="{{ route('plants.qr', $plant) }}" class="btn btn-dark" data-mdb-ripple-init target="_blank">
                        <i class="fas fa-qrcode me-2"></i> Tampilkan QR
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a
                      data-mdb-tab-init
                      class="nav-link active"
                      id="desc-tab"
                      href="#desc-content"
                      role="tab"
                      aria-controls="desc-content"
                      aria-selected="true"
                      >Deskripsi</a
                    >
                  </li>
                  <li class="nav-item" role="presentation">
                    <a
                      data-mdb-tab-init
                      class="nav-link"
                      id="tips-tab"
                      href="#tips-content"
                      role="tab"
                      aria-controls="tips-content"
                      aria-selected="false"
                      >Tips Perawatan</a
                    >
                  </li>
                  <li class="nav-item" role="presentation">
                    <a
                      data-mdb-tab-init
                      class="nav-link"
                      id="benefits-tab"
                      href="#benefits-content"
                      role="tab"
                      aria-controls="benefits-content"
                      aria-selected="false"
                      >Manfaat</a
                    >
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="desc-content" role="tabpanel" aria-labelledby="desc-tab">
                    <h5>Deskripsi</h5>
                    <p>{{ $plant->description ?? 'Tidak ada deskripsi.' }}</p>
                    <hr>
                    <h5>Habitat Asli</h5>
                    <p>{{ $plant->habitat ?? 'Tidak ada info habitat.' }}</p>
                  </div>
                  <div class="tab-pane fade" id="tips-content" role="tabpanel" aria-labelledby="tips-tab">
                    @forelse($plant->tips as $tip)
                        <h5>Tips Perawatan</h5>
                        <p><strong>Penyiraman:</strong> {{ $tip->watering_tips ?? '-' }}</p>
                        <p><strong>Pencahayaan:</strong> {{ $tip->lighting_tips ?? '-' }}</p>
                        <p><strong>Media Tanam:</strong> {{ $tip->soil_media ?? '-' }}</p>
                    @empty
                        <p>Belum ada tips perawatan untuk tanaman ini.</p>
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <a href="{{ route('plant-tips.create', ['plant_id' => $plant->id]) }}" class="btn btn-sm btn-outline-primary" data-mdb-ripple-init>Tambah Tips</a>
                        @endif
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="benefits-content" role="tabpanel" aria-labelledby="benefits-tab">
                    <h5>Manfaat Kesehatan</h5>
                    <p>{{ $plant->health_benefits ?? 'Tidak ada info.' }}</p>
                    <hr>
                    <h5>Manfaat Kultural</h5>
                    <p>{{ $plant->cultural_benefits ?? 'Tidak ada info.' }}</p>
                  </div>
                </div>
                </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Progres Pertumbuhan</h5>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <a href="{{ route('plant-progresses.create', ['plant_id' => $plant->id]) }}" class="btn btn-sm btn-primary" data-mdb-ripple-init>
                    <i class="fas fa-plus me-2"></i> Catat Progres
                </a>
                @endif
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($plant->progresses->sortByDesc('progress_date') as $progress)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $progress->progress_date->format('d M Y') }} - 
                                <span class="badge badge-info">{{ $progress->progress_type }}</span>
                            </span>
                            <small class="text-muted">oleh: {{ $progress->user->name ?? 'N/A' }}</small>
                        </div>
                        <p class="mb-0 mt-2">{{ $progress->description }}</p>
                    </li>
                    @empty
                    <li class="list-group-item text-center">Belum ada progres yang dicatat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection