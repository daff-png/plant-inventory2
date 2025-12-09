@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Progres Tanaman</h2>
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
        <a href="{{ route('plant-progresses.create') }}" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fas fa-plus me-2"></i> Tambah Progres
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Tanaman</th>
                        <th>Tipe Progres</th>
                        <th>Tanggal</th>
                        <th>Dicatat Oleh</th>
                        <th>Deskripsi Singkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($progresses as $progress)
                    <tr>
                        <td>
                            <a href="{{ route('plants.show', $progress->plant_id) }}">
                                {{ $progress->plant->plant_name ?? 'N/A' }}
                            </a>
                        </td>
                        <td>
                            @if($progress->progress_type == 'planting')
                                <span class="badge badge-primary rounded-pill d-inline">Tanam</span>
                            @elseif($progress->progress_type == 'growing')
                                <span class="badge badge-success rounded-pill d-inline">Tumbuh</span>
                            @else
                                <span class="badge badge-info rounded-pill d-inline">Panen</span>
                            @endif
                        </td>
                        <td>{{ $progress->progress_date->format('d M Y') }}</td>
                        <td>{{ $progress->user->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($progress->description, 50) }}</td>
                        <td>
                            <a href="{{ route('plant-progresses.show', $progress) }}" class="btn btn-sm btn-info" data-mdb-ripple-init>
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <a href="{{ route('plant-progresses.edit', $progress) }}" class="btn btn-sm btn-warning" data-mdb-ripple-init>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @endif
                            
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $progress->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $progress->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus (soft delete) progres ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('plant-progresses.destroy', $progress) }}" method="POST" style="display: inline;">
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
                        <td colspan="6" class="text-center">Tidak ada data progres.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $progresses->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection