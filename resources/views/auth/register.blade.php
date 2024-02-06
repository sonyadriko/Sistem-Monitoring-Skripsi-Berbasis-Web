@extends('layout.master_login')

@section('title')
    Login
@endsection

@section('content')

    <div class="d-lg-flex half">
        <div class="contents order-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div style="text-align: center">
                            <img src="{{ asset('img/login/itats.png') }}" alt="User Icon" class="img-fluid" style="max-width: 600px;">
                            <img src="{{ asset('img/login/logo_si_mini_normal.svg') }}" alt="User Icon" class="img-fluid" style="max-width: 600px;">
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary text-center" style="text-align: center">Register</h2>
                        </div>
                        <script>
                            @if($errors->any())
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ $errors->first() }}',
                                });
                            @endif
                        </script>
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
                        <div class="mt-3 text-center">
                            <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-dark">Login</a></p>
                        </div>
                        <p class="text-center mt-4" style="color: #171717">&copy; <script>document.write(new Date().getFullYear())</script> Sistem Informasi ITATS</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="bg d-none d-lg-block order-1" style="background-image: url('{{ asset('img/login/img_login.svg') }}'); background-size: cover;"></div>
    </div>

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
