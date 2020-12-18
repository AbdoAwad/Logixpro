@extends('auth.layouts.app')
@section('content')
<div class="auth">
    <div class="auth_left">
        <div class="card">
            <div class="text-center mb-5">
                <a class="header-brand" href="index.html"><i class="fe fe-command brand-logo"></i></a>
            </div>
            <div class="card-body">
                <div class="card-title">Forgot password</div>
                <p class="text-muted">Enter your email address and reset link will be emailed to you.</p>
                @include('layouts.ms')
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="exampleInputEmail1">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block"> Send me Reset Password Link</button>
                    </div>
                </form>
            </div>
            <div class="text-center text-muted">
                Forget it, <a href="{{ route('login') }}">Send me Back</a> to the Sign in screen.
            </div>
        </div>        
    </div>
@endsection
