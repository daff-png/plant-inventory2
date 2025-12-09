@extends('layouts.app')

@section('content')
<h2>Edit Progres Tanaman: {{ $plantProgress->plant->plant_name ?? '' }}</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plant-progresses.update', $plantProgress) }}" method="POST">
            @method('PUT')
            @include('plant-progresses._form', ['submitButtonText' => 'Update Progres'])
        </form>
    </div>
</div>
@endsection