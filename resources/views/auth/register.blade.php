@extends('layout.master2')

@section('title')
    Register
@endsection

@section('content')

<!-- Section: Design Block -->
<section class="h-100 d-flex justify-content-center align-items-center" style="background: linear-gradient(to bottom, #1D4ED8 50%, #3B82F6);">
    <!-- Jumbotron -->
    <div class="container-fluid px-4 py-5 text-center text-lg-start">
        <div class="row justify-content-center align-items-start"> <!-- Updated to align-items-start -->
            <div class="col-lg-6 mb-5 mb-lg-0 text-center d-none d-md-block"> <!-- Removed text-lg-start -->
                <h1 class="my-5 display-3 fw-bold ls-tight text-white">
                    SM SKRIPSI <br />
                </h1>
                <img src="{{ asset('img/User_Mahasiswa.svg') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">

                <p class="text-white">&copy; <script>document.write(new Date().getFullYear())</script> Sistem Informasi ITATS</p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card mx-auto" style="max-width: 500px;">
                    <div class="card-body py-5 px-md-5">
                        <h2 class="text-primary text-center mb-4">Register</h2>

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label text-dark text-left">{{ __('Nama Lengkap') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror text-dark" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kode_unik" class="form-label text-dark text-left">{{ __('Npm') }}</label>
                                <input id="kode_unik" type="text" class="form-control @error('kode_unik') is-invalid @enderror text-dark" name="kode_unik" value="{{ old('kode_unik') }}" required autocomplete="kode_unik" autofocus>
                                @error('kode_unik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-dark text-left">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror text-dark" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-dark text-left">{{ __('Kata Sandi') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror text-dark" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label text-dark text-left">{{ __('Ulang Kata Sandi') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <label for="ktm" class="form-label text-dark text-left">Upload KTM (Kartu Tanda Mahasiswa)</label>
                                <input class="form-control" type="file" name="ktm" id="ktm" />
                                <p class="text-danger"> File: PDF | Size Max: 1MB.</p>
                                @error('ktm')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </div>
                        </form>

                        <!-- Redirect link -->
                        <div class="mt-3 text-center">
                            <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-dark">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}'; // Ganti dengan URL halaman login yang sesuai
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
            });
        @endif
    });
</script>
