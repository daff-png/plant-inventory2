@extends('layouts.app')

@section('content')
<h2>Edit Petugas: {{ $user->name }}</h2>
<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @method('PUT')
            @include('admin.users._form', ['submitButtonText' => 'Update User'])
        </form>
    </div>
</div>
@endsection