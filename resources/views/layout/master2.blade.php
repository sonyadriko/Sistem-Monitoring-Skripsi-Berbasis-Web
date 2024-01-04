<!DOCTYPE html>
<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_laravel
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
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

	@stack('plugin-styles')

	<!-- common css -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
	<!-- end common css -->

	@stack('style')
</head>

<body class="sidebar-dark" data-base-url="{{ url('/') }}">

	<script src="{{ asset('assets/js/spinner.js') }}"></script>

	<div class="main-wrapper" id="app">
		<div class="page-wrapper full-page">
			@yield('content')
		</div>
	</div>

	<!-- base js -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
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
</body>

</html>
