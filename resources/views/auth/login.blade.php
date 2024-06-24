@extends('layout.master_login')

@section('title', 'Login')

@section('content')
    <div class="d-lg-flex half">
        <!-- Main content section -->
        <div class="contents order-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <!-- Logo and images section -->
                        <div class="text-center">
                            <img src="{{ asset('img/login/itats.png') }}" alt="ITATS Logo" class="img-fluid mb-3"
                                style="max-width: 600px;">
                            <img src="{{ asset('img/login/logo_si_mini_normal.svg') }}" alt="SI Logo"
                                class="img-fluid mb-3" style="max-width: 600px;">
                        </div>
                        <!-- Login page title and description -->
                        <div class="mb-4 text-center">
                            <h2 class="text-primary mb-4">Login</h2>
                            <p class="mb-4" style="color: #7987A1; font-size: 14px;">Izinkan Sistem mengenali anda.</p>
                        </div>
                        <!-- Error message script -->
                        @if ($errors->any())
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ $errors->first() }}',
                                });
                            </script>
                        @endif
                        <!-- Login form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror text-dark"
                                    name="email" id="email" placeholder="Email" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password input -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-dark">Password</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror text-dark" name="password"
                                    id="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Submit button -->
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                        <!-- Registration link -->
                        <div class="mt-3 text-center">
                            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}"
                                    class="text-dark">Register</a></p>
                        </div>
                        <!-- Footer with dynamic year -->
                        <p class="text-center mt-4" style="color: #171717;">&copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Sistem Informasi ITATS
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image section -->
        <div class="bg d-none d-lg-block order-1"
            style="background-image: url('{{ asset('img/login/img_login.webp') }}'); background-size: cover;"></div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
