@extends('layouts.app')

@section('content')
<h2>Tambah Petugas Baru</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @include('admin.users._form', ['submitButtonText' => 'Simpan User'])
        </form>
    </div>
</div>
@endsection