@extends('main.layouts.app')

@section('content')
<section class="page-title parallaxie" data-bg-img="{{ asset('main/images/bg/08.jpg') }}"">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h1>تأكيد البريد الإلكتروني</h1>
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('main')}}">الرئيسية</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">تأكيد البريد الإلكتروني</li>
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
              <h5 class="mb-4">لقد تم إرسال رسالة تأكيد إلى بريدك الإلكتروني</h5>
              <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('تم ارسال رسالة تأكيد جديدة الى حسابك') }}
                    </div>
                @endif

                {{ __( 'من فضلك قم بتأكيد البريد الإلكتروني لتتمكن من استكمال عملية التسجيل ') }}
                <br>

                {{ __('اذا لم تستلم رسالة تأكيد لتأكيد حسابك') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-block mt-2">الرجاء اضغط هنا لاعادة الإرسال</button>
                </form>
            </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </div>
@endsection
