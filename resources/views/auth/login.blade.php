@extends('auth.layouts.app')

@section('content')
<div class="auth">
    <div class="auth_left">
        <div class="card">
            <div class="text-center mb-2">
                <a class="header-brand" ><i class="fe fe-command brand-logo"></i></a>
            </div>
            <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="card-body">
                    <div class="card-title">Login to your account</div>
                    <div class="form-group">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                           
                        
                        {{-- <label class="form-label">Password  @if (Route::has('password.request')) <a  href="{{ route('password.request') }}" class="float-right small">I forgot password</a>@endif</label> --}}
                        <label class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                    </div>
                </div>
            </form>    
            {{-- <div class="text-center text-muted">
                Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
            </div> --}}
        </div>        
    </div>
@endsection
