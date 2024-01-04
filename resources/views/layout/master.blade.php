<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="ie=edge" http-equiv="X-UA-Compatible">
	<meta content="Sistem Manajemen Skripsi" name="description">
    <meta content="ITATS" name="author">
	<meta content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web" name="keywords">

	<title>@yield('title')</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<!-- End fonts -->

	<!-- CSRF Token -->
	<meta content="{{ csrf_token() }}" name="_token">

	<link href="{{ asset('/favicon.ico') }}" rel="shortcut icon">

	<!-- plugin css -->
	<link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
	<!-- end plugin css -->
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

	@stack('plugin-styles')

	<!-- common css -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
	<!-- end common css -->

	@stack('style')

	{{-- @include('layout.head-css') --}}
</head>

<body class="sidebar-dark" data-base-url="{{ url('/') }}">

	<script src="{{ asset('assets/js/spinner.js') }}"></script>

	<div class="main-wrapper" id="app">
		@include('layout.sidebar')
		<div class="page-wrapper">
			@include('layout.header')
			<div class="page-content">
				@yield('content')
			</div>
			@include('layout.footer')
		</div>
	</div>

	<!-- base js -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<!-- end base js -->

	<!-- plugin js -->
	@stack('plugin-scripts')
	<!-- end plugin js -->

	<!-- common js -->
	<script src="{{ asset('assets/js/template.js') }}"></script>
	<!-- end common js -->

	@stack('custom-scripts')
	<script>
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'csrftoken': '{{ csrf_token() }}'
				}
			});
			var token = '{{ Session::token() }}';
			$('.notifications').on('click', function() {
				$.ajax({
					url: '{{ route('notifications') }}',
					method: 'GET',
					_token: token,
					data: {},
					async: true,
					dataType: 'json',
					beforeSend: function() {},
					success: function(data) {
						$('.nk-notification').html(data.notifications);
					}
				});
			});
		});
	</script>

	<!-- JAVASCRIPT -->
	{{-- @include('layout.vendor-scripts') --}}
</body>

</html>
