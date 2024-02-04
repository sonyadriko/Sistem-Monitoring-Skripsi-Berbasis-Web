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
                        <div class="mb-4" style="text-align: center">
                            <img src="{{ asset('img/login/itats.png') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                            <img src="{{ asset('img/login/logo_si_mini_normal.svg') }}" alt="User Icon" class="img-fluid mb-3" style="max-width: 600px;">
                        </div>
                        <div class="mb-4">
                            <h2 class="text-primary text-center mb-4" style="text-align: center">Login</h2>
                            <p class="mb-4" style="text-align: center; color: #7987A1; font-size: 14px">Izinkan Sistem mengenali anda.</p>
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

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-dark">Register</a></p>
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
