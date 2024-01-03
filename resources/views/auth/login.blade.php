@extends('layout.master2')

@section('title')
Login
@endsection

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
  <div class="row w-75 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          </div>
          <div class="col-md-8 ps-md-0 mx-auto">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Login<span></span></a>
              <h5 class="text-muted fw-normal mb-4">Izinkan Sistem mengenali anda.</h5>
              {{-- Tambahkan kode untuk menampilkan pesan error --}}
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
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                        {{-- <a href="{{ route('password.request') }}" class="btn btn-link">
                            Forgot Your Password?
                        </a> --}}
                    </div>
                </div>
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
