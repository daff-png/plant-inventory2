@extends('layouts.app')

@section('page-title', 'Tambah Tip Perawatan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-2-strong rounded-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Formulir Tip Perawatan</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('plant-tips.store') }}" method="POST">
                    @include('plant-tips._form', ['submitButtonText' => 'Simpan Tip'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection