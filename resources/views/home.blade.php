@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow-lg border-0">
                
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">{{ __('Dashboard Utama') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-4 p-3 bg-light border-start border-5 border-success rounded">
                        <h4 class="text-success">
                            <i class="fas fa-seedling me-2"></i> Selamat Datang, {{ Auth::user()->name }}!
                        </h4>
                        <p class="mb-0">Anda saat ini login sebagai: {{ strtoupper(Auth::user()->role) }}</p>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h5 class="mb-3 text-secondary">Akses Cepat ke Fitur Utama</h5>
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm transition-hover-shadow">
                                <div class="card-body text-center">
                                    <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Daftar Tanaman</h5>
                                    <p class="card-text text-muted">Lihat, cari, dan kelola semua tanaman yang terdaftar di sistem.</p>
                                    <a href="{{ route('plants.index') }}" class="btn btn-outline-success mt-2">Lihat Daftar <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm transition-hover-shadow">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                                    <h5 class="card-title">Progres Tanaman</h5>
                                    <p class="card-text text-muted">Catat dan lihat riwayat perkembangan serta pertumbuhan tanaman.</p>
                                    <a href="{{ route('plant-progresses.index') }}" class="btn btn-outline-info mt-2">Lihat Progres <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 bg-light border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Tambah Data Baru</h5>
                                    <p class="card-text text-muted">Tambahkan data tanaman atau progres terbaru dengan cepat.</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('plants.create') }}" class="btn btn-success btn-sm"><i class="fas fa-leaf me-1"></i> Tanaman Baru</a>
                                        <a href="{{ route('plant-progresses.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-chart-bar me-1"></i> Progres Baru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if(Auth::user()->role == 'admin')
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 bg-danger text-white border-0 shadow-sm transition-hover-shadow">
                                <div class="card-body text-center">
                                    <i class="fas fa-users-cog fa-3x mb-3"></i>
                                    <h5 class="card-title">Manajemen Petugas</h5>
                                    <p class="card-text">Kelola semua akun pengguna (admin, staff, user) yang terdaftar.</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-light mt-2">Kelola Akun <i class="fas fa-user-shield ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .transition-hover-shadow {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .transition-hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
</style>
@endsection