@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Petugas</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary" data-mdb-ripple-init>
        <i class="fas fa-plus me-2"></i> Tambah Petugas
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge badge-danger rounded-pill d-inline">Admin</span>
                            @elseif($user->role == 'staff')
                                <span class="badge badge-warning rounded-pill d-inline">Staff</span>
                            @else
                                <span class="badge badge-secondary rounded-pill d-inline">User</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning" data-mdb-ripple-init>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $user->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus (soft delete) user <strong>{{ $user->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
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
                        <td colspan="4" class="text-center">Tidak ada data user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection