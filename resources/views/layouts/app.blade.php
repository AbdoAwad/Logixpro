<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en">

    <link rel="shortcut icon" href="{{ asset('front/images/fav.png') }}" type=image/png>
	<link rel=icon href="{{ asset('front/images/fav.png') }}" type=image/png>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <title>{{ env('APP_NAME', 'logixpro') }}</title>
    
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">

	<!-- Plugins css -->
	<link rel="stylesheet" href="{{asset('plugins/charts-c3/c3.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>
	
    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/theme1.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/global.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/theme2.css') }}"/>
	
    @stack('css')
</head>

<body class="font-montserrat sidebar_dark">
	<!-- Page Loader -->
	<div class="page-loader-wrapper">
		<div class="loader">
		</div>
	</div>

	<div id="main_content">
		@include('layouts.sidebar')

		<div class="page">
			@include('layouts.header', ['header_title' => $header_title ?? ''])

			<div class="section-body mt-3">
				@yield('content')
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
	<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

	<script src="{{ asset('js/core.js') }}"></script>
	<script src="{{ asset('js/global.js') }}"></script>


	@stack('js')
</body>
</html>
