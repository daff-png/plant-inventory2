@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-0 border">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">{{ __('Login') }}</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col"> 
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember"> {{ __('Remember Me') }} </label>
                                </div>
                            </div>

                            <div class="col">
                                </div>
                        </div>

                        <button data-mdb-ripple-init type="submit" class="btn btn-success btn-block mb-4">
                            {{ __('Login') }}
                        </button>

                        <div class="text-center">
                            <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection