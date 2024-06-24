@extends('layout.master_login')

@section('title', 'Login')

@section('content')
    <div class="d-lg-flex half">
        <div class="contents order-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div class="text-center">
                            <img src="{{ asset('img/login/itats.webp') }}" alt="ITATS Logo" class="img-fluid mb-3"
                                width="100" height="100">
                            <img src="{{ asset('img/login/logo_si_mini_normal.webp') }}" alt="SI Logo"
                                class="img-fluid mb-3" width="100" height="100">
                        </div>
                        <div class="mb-4 text-center">
                            <h2 class="text-primary mb-4">Login</h2>
                            <p class="mb-4 text-muted">Izinkan Sistem mengenali anda.</p>
                        </div>
                        @if ($errors->any())
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: '{{ $errors->first() }}',
                                    });
                                });
                            </script>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
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
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}"
                                    class="text-dark">Register</a></p>
                        </div>
                        <p class="text-center mt-4 text-muted">&copy; <span id="currentYear"></span> Sistem Informasi ITATS
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg d-none d-lg-block order-1 lazy" data-bg="url('{{ asset('img/login/img_login.webp') }}')"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
        document.addEventListener("DOMContentLoaded", function() {
            let lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy"));
            if ("IntersectionObserver" in window) {
                let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.style.backgroundImage = entry.target.getAttribute(
                                "data-bg");
                            lazyBackgroundObserver.unobserve(entry.target);
                        }
                    });
                });
                lazyBackgrounds.forEach(function(lazyBackground) {
                    lazyBackgroundObserver.observe(lazyBackground);
                });
            }
        });
    </script>
@endsection
