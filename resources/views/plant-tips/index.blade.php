@extends('layouts.app')

@section('page-title', 'Manajemen Tips Perawatan') @section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
        <a href="{{ route('plant-tips.create') }}" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fas fa-plus me-2"></i> Tambah Tip
        </a>
    @endif
</div>

<div class="card shadow-2-strong rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="py-3">Tanaman</th>
                        <th class="py-3">Tips Penyiraman</th>
                        <th class="py-3">Tips Cahaya</th>
                        <th class="text-center py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tips as $tip)
                    <tr>
                        <td>
                            <a href="{{ route('plants.show', $tip->plant_id) }}" class="fw-bold">
                                {{ $tip->plant->plant_name ?? 'N/A' }}
                            </a>
                        </td>
                        <td>{{ Str::limit($tip->watering_tips, 50) }}</td>
                        <td>{{ Str::limit($tip->lighting_tips, 50) }}</td>
                        <td class="text-center">
                            <a href="{{ route('plant-tips.show', $tip) }}" class="btn btn-sm btn-info" data-mdb-ripple-init data-mdb-tooltip-init title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <a href="{{ route('plant-tips.edit', $tip) }}" class="btn btn-sm btn-warning" data-mdb-ripple-init data-mdb-tooltip-init title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @endif
                            
                            @if(Auth::user()->role == 'admin')
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $tip->id }}" data-mdb-tooltip-init title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $tip->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus (soft delete) tip untuk <strong>{{ $tip->plant->plant_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('plant-tips.destroy', $tip) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-mdb-ripple-init>Ya, Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            <i class="fas fa-search-minus fa-2x text-muted mb-2"></i>
                            <p class="mb-0">Tidak ada data tips perawatan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $tips->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection