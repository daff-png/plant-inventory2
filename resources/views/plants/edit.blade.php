@extends('layouts.app')

@section('content')
<h2>Edit Tanaman: {{ $plant->plant_name }}</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plants.update', $plant) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('plants._form', ['submitButtonText' => 'Update Tanaman'])
        </form>
    </div>
</div>
@endsection