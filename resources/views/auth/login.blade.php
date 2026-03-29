@extends('layouts.auth')

@section('content')
<div class="auth-title">{{ __('Login') }}</div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="mb-3 form-check text-start">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <button type="submit" class="btn-auth">
        {{ __('Login') }}
    </button>

    <div class="auth-links mt-auto">
        @if (Route::has('password.request'))
            <p><a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a></p>
        @endif
    </div>
</form>
@endsection
