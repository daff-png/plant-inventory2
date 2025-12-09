@extends('layouts.app')

@section('content')
<h2>Catat Progres Tanaman Baru</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plant-progresses.store') }}" method="POST">
            @include('plant-progresses._form', ['submitButtonText' => 'Simpan Progres'])
        </form>
    </div>
</div>
@endsection