@extends('layout.master2')

@section('content')
<!-- Konten utama untuk halaman error 404 -->
<div class="page-content d-flex align-items-center justify-content-center">
    <!-- Menggunakan grid Bootstrap untuk responsivitas -->
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
            <!-- Menampilkan gambar ilustrasi 404 -->
            <img src="{{ url('assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="404">
            <!-- Judul dan deskripsi error -->
            <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
            <h4 class="mb-2">Page Not Found</h4>
            <h6 class="text-muted mb-3 text-center">Oopps!! The page you were looking for doesn't exist.</h6>
            <!-- PHP Script untuk menentukan URL berdasarkan role pengguna -->
            @php
            $roleUrls = [
                2 => '/dosen',
                3 => '/koordinator',
                4 => '/ketua_jurusan',
                'default' => '/dashboard'
            ];
            $dashboardUrl = url($roleUrls[auth()->user()->role_id] ?? $roleUrls['default']);
            @endphp
            <!-- Link untuk kembali ke halaman utama -->
            <a href="{{ $dashboardUrl }}" class="nav-link" style="color: #007bff; text-decoration: underline; font-weight: bold;">Back to home</a>
        </div>
    </div>
</div>
@endsection
