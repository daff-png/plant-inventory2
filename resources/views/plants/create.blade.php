@extends('layouts.app')

@section('content')
<h2>Tambah Tanaman Baru</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
            @include('plants._form', ['submitButtonText' => 'Simpan Tanaman'])
        </form>
    </div>
</div>
@endsection