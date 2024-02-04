<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assetlogin/fonts/icomoon/style.css')}}">

        <link rel="stylesheet" href="{{ asset('assetlogin/css/owl.carousel.min.css')}}">

        <title>@yield('title')</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assetlogin/css/bootstrap.min.css')}}">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('assetlogin/css/style.css')}}">


            <!-- CSRF Token -->
        <meta content="{{ csrf_token() }}" name="_token">

        <link href="{{ asset('/favicon.ico') }}" rel="shortcut icon">

        <!-- plugin css -->
        <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />

        @stack('plugin-styles')

        <!-- common css -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <!-- end common css -->

        @stack('style')


    </head>
    <body>
        <div class="main-wrapper" id="app">
            <div class="page-wrapper full-page">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('assetlogin/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('assetlogin/js/popper.min.js')}}"></script>
        <script src="{{ asset('assetlogin/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assetlogin/js/main.js')}}"></script>

        <!-- base js -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
	<!-- end base js -->

	<!-- plugin js -->
	@stack('plugin-scripts')
	<!-- end plugin js -->

	<!-- common js -->
	<script src="{{ asset('assets/js/template.js') }}"></script>

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
