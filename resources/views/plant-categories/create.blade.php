@extends('layouts.app')

@section('content')
<h2>Tambah Kategori Baru</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plant-categories.store') }}" method="POST">
            @csrf
            @include('plant-categories._form', ['submitButtonText' => 'Simpan Kategori'])
        </form>
    </div>
</div>
@endsection