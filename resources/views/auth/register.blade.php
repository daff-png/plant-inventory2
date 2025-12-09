@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-0 border">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">{{ __('Register') }}</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                            <label class="form-label" for="name">{{ __('Name') }}</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                            <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection