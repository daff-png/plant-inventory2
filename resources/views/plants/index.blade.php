@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Tanaman</h2>
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
        <a href="{{ route('plants.create') }}" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fas fa-plus me-2"></i> Tambah Tanaman
        </a>
    @endif
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('plants.index') }}" method="GET">
            <div class="input-group">
                <div data-mdb-input-init class="form-outline" style="flex: 1;">
                    <input type="search" id="search" name="search" class="form-control" value="{{ request('search') }}" />
                    <label class="form-label" for="search">Cari Nama Tanaman...</label>
                </div>
                <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Nama Tanaman</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Stok</th>
                        <th>Dicatat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plants as $plant)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img
                                    src="{{ $plant->photo ? asset('storage/' . $plant->photo) : 'https://via.placeholder.com/60' }}"
                                    alt=""
                                    style="width: 60px; height: 60px"
                                    class="rounded-circle"
                                    />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $plant->plant_name }}</p>
                                    <p class="text-muted mb-0">{{ $plant->latin_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-secondary rounded-pill d-inline">{{ $plant->category->category_name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($plant->condition == 'healthy')
                                <span class="badge badge-success rounded-pill d-inline">Sehat</span>
                            @elseif($plant->condition == 'sick')
                                <span class="badge badge-warning rounded-pill d-inline">Sakit</span>
                            @else
                                <span class="badge badge-danger rounded-pill d-inline">Mati</span>
                            @endif
                        </td>
                        <td>{{ $plant->stock }}</td>
                        <td>{{ $plant->user->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('plants.show', $plant) }}" class="btn btn-sm btn-info" data-mdb-ripple-init>
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <a href="{{ route('plants.qr', $plant) }}" class="btn btn-sm btn-dark" data-mdb-ripple-init title="Generate QR Code" target="_blank">
                                <i class="fas fa-qrcode"></i>
                            </a>
                            
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <a href="{{ route('plants.edit', $plant) }}" class="btn btn-sm btn-warning" data-mdb-ripple-init>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @endif
                            
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $plant->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $plant->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus (soft delete) tanaman <strong>{{ $plant->plant_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('plants.destroy', $plant) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-mdb-ripple-init>Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data tanaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $plants->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection