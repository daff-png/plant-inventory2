@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Daftar Kategori Tanaman</h2>
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
        <a href="{{ route('plant-categories.create') }}" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fas fa-plus me-2"></i> Tambah Kategori
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td><strong>{{ $category->category_name }}</strong></td>
                        <td>{{ Str::limit($category->description, 100) }}</td>
                        <td>
                            <a href="{{ route('plant-categories.show', $category) }}" class="btn btn-sm btn-info" data-mdb-ripple-init>
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <a href="{{ route('plant-categories.edit', $category) }}" class="btn btn-sm btn-warning" data-mdb-ripple-init>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @endif
                            
                            @if(Auth::user()->role == 'admin')
                            <button type="button" class="btn btn-sm btn-danger" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal-{{ $category->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <div class="modal fade" id="deleteModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus (soft delete) kategori <strong>{{ $category->category_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Batal</button>
                                            <form action="{{ route('plant-categories.destroy', $category) }}" method="POST" style="display: inline;">
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
                        <td colspan="3" class="text-center">Tidak ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection