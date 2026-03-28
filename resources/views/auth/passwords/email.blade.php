@extends('layouts.auth')

@section('content')
<div class="auth-title">{{ __('Reset Password') }}</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <button type="submit" class="btn-auth">
        {{ __('Send Password Reset Link') }}
    </button>

    <div class="auth-links">
        <hr>
        <p><a href="{{ route('login') }}">Back to Login</a></p>
    </div>
</form>
@endsection
