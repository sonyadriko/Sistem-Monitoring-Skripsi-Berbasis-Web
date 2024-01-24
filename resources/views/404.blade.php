@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
            <img src="{{ url('assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="404">
            <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
            <h4 class="mb-2">Page Not Found</h4>
            <h6 class="text-muted mb-3 text-center">Oopps!! The page you were looking for doesn't exist.</h6>
            {{-- <a href="{{ url('/') }}"></a> --}}
            @php
            $dashboardUrl = '';
                switch (auth()->user()->role_id) {
                    case 2:
                        $dashboardUrl = url('/dosen');
                        break;
                    case 3:
                        $dashboardUrl = url('/koordinator');
                        break;
                    case 4:
                        $dashboardUrl = url('/ketua_jurusan');
                        break;
                    default:
                        $dashboardUrl = url('/dashboard');
                }
            @endphp
            {{-- <a href="{{ $dashboardUrl }}" class="nav-link">Back to home</a> --}}
            <a href="{{ $dashboardUrl }}" class="nav-link" style="color: #007bff; text-decoration: underline; font-weight: bold;">Back to home</a>

        </div>
    </div>
</div>
@endsection
