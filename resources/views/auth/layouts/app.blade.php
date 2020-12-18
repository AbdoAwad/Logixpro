<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="{{ asset('front/images/fav.png') }}" type=image/png/>
<link rel="shortcut icon" href="{{ asset('main/images/favicon.ico') }}" />
<title>Tohama</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

<!-- Core css -->
<link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/theme1.css') }}"/>
@stack('css')
</head>
<body class="font-montserrat sidebar_dark">
	@yield('content')
	<div class="auth_right">
			<div class="carousel slide" data-ride="carousel" data-interval="3000">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="{{asset('images/slider3.svg')}}" class="img-fluid" alt="login page" />
						<div class="px-4 mt-4">
							<h4>Welcome To Logixpro</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="div-modal"></div>
	@stack('modal')
	<script src="{{ asset('bundles/lib.vendor.bundle.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="{{ asset('plugins/animated-modal/animatedModal.min.js') }}"></script>
	<script src="{{ asset('bundles/lib.vendor.bundle.js')}}"></script>
	<script src="{{ asset('js/core.js')}}"></script>
	@stack('js')
</body>
</html>
