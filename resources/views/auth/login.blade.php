@extends('layout.master2')

@section('title')
    Login
@endsection

@section('content')

<!-- Section: Design Block -->
<section class="h-100 d-flex justify-content-center align-items-center" style="background: linear-gradient(to bottom, #1D4ED8 50%, #3B82F6);">
    <!-- Jumbotron -->
    <div class="container-fluid px-4 py-5 text-center text-lg-start">
        <div class="row justify-content-center align-items-start"> <!-- Updated to align-items-start -->
            <div class="col-lg-6 mb-5 mb-lg-0 text-center d-none d-md-block"> <!-- Removed text-lg-start -->
                <img src="{{ asset('img/login/itats.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                <img src="{{ asset('img/login/Logo_SI_Mini_Putih_1.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">

                <h1 class="display-4 fw-bold ls-tight text-white" style="font-size: 42px">
                    Sistem Monitoring Skripsi <br />
                    {{-- <span class="text-primary">Sistem Monitoring Skripsi</span> --}}
                </h1>
                <h1 class="fw-bold ls-tight text-white mb-4 mt-4" style="font-size: 24px">
                  Anda dapat masuk sebagai <br />
                    {{-- <span class="text-primary">Sistem Monitoring Skripsi</span> --}}
                </h1>
                <img src="{{ asset('img/login/User_Mahasiswa.svg') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                <img src="{{ asset('img/login/User_Dosen.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                <img src="{{ asset('img/login/User_Koordinator.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                <img src="{{ asset('img/login/user _Ketua Jurusan.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">

                <p class="text-white mt-4">&copy; <script>document.write(new Date().getFullYear())</script> Sistem Informasi ITATS</p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card mx-auto" style="max-width: 500px;">
                    <div class="card-body py-5 px-md-5">
                        <h2 class="text-primary text-center mb-4">Login</h2>
                        <p class="text-muted text-center mb-4">Izinkan Sistem mengenali anda.</p>
                        <!-- Display error message -->

                        <script>
                            @if($errors->any())
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ $errors->first() }}',
                                });
                            @endif
                        </script>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label text-dark">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror text-dark" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-dark">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror text-dark" name="password" id="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-dark" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>

                        <!-- Registration link -->
                        <div class="mt-3 text-center">
                            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-dark">Register</a></p>
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
