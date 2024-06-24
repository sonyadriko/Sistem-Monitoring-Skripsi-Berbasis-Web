<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <style>
        /* Critical CSS for Roboto font */
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            src: local('Roboto Light'), local('Roboto-Light'), url(https://fonts.gstatic.com/s/roboto/v27/KFOlCnqEu92Fr1MmEU9fBBc9.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: local('Roboto Regular'), local('Roboto-Regular'), url(https://fonts.gstatic.com/s/roboto/v27/KFOmCnqEu92Fr1Mu72xKOzY.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            src: local('Roboto Medium'), local('Roboto-Medium'), url(https://fonts.gstatic.com/s/roboto/v27/KFOlCnqEu92Fr1MmYUtfBBc9.ttf) format('truetype');
        }

        /* Additional critical CSS styles here if needed */
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assetlogin/css/bootstrap.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assetlogin/css/style.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}">

    <!-- Google Fonts - Roboto -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap">
    </noscript>



    <!-- Favicon -->
    <link href="{{ asset('/favicon.ico') }}" rel="shortcut icon">

    <!-- Additional Styles -->
    @stack('plugin-styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('style')
</head>

<body>
    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">
            @yield('content')
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="{{ asset('assetlogin/js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('assetlogin/js/popper.min.js') }}" defer></script>
    <script src="{{ asset('assetlogin/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assetlogin/js/main.js') }}" defer></script>

    <!-- Base JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    @stack('plugin-scripts')

    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    @stack('custom-scripts')

    <!-- Ajax CSRF Setup -->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</body>

</html>
