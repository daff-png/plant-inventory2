@extends('layouts.app')

@section('page-title', 'Edit Tip Perawatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-2-strong rounded-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Edit Tip untuk: {{ $plantTip->plant->plant_name ?? 'N/A' }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('plant-tips.update', $plantTip) }}" method="POST">
                    @method('PUT')
                    @include('plant-tips._form', ['submitButtonText' => 'Update Tip'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection