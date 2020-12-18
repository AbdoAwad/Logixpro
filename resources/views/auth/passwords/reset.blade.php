@extends('main.layouts.app')

@section('content')
<section class="page-title parallaxie" data-bg-img="{{ asset('main/images/bg/08.jpg') }}"">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h1>اعادة تعيين كلمة المرور</h1>
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('main')}}">الرئيسية</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">اعادة تعيين كلمة المرور</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <div class="page-content">

    <section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7 col-md-12">
            <div class="box-shadow white-bg text-center px-5 py-5 md-px-3 md-py-3 xs-px-2 xs-py-2">
                <div class="card">
                    <div class="card-header">اعادة تعيين كلمة المرور</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">كلمة المرور</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="btn btn-block mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        اعادة تعيين كلمة المرور
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
    </div>
</div>
@endsection
