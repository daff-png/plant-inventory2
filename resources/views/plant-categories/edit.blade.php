@extends('layouts.app')

@section('content')
<h2>Edit Kategori: {{ $plantCategory->category_name }}</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('plant-categories.update', $plantCategory) }}" method="POST">
            @method('PUT')
            @include('plant-categories._form', ['submitButtonText' => 'Update Kategori'])
        </form>
    </div>
</div>
@endsection