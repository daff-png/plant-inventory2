@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 text-danger"><i class="fas fa-trash me-2"></i> Keranjang Sampah - Petugas</h2>
    <a href="{{ route('users.index') }}" class="btn btn-light" data-mdb-ripple-init>
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Manajemen Petugas
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trashedUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->deleted_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('users.restore', $user->id) }}" class="btn btn-sm btn-success" data-mdb-ripple-init>
                                <i class="fas fa-undo"></i> Restore
                            </a>
                            
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $user->id }}">
                                <i class="fas fa-exclamation-triangle"></i> Hapus Permanen
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">PERINGATAN!</h5>
                                            <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus <strong>PERMANEN</strong> user <strong>{{ $user->name }}</strong>?
                                            <br><strong>Data ini tidak dapat dikembalikan!</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-mdb-ripple-init>Ya, Hapus Permanen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data di keranjang sampah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $trashedUsers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection