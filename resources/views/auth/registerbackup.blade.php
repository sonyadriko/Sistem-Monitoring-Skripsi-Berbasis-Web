@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kode_unik" class="col-md-4 col-form-label text-md-end">{{ __('Npm') }}</label>

                            <div class="col-md-6">
                                <input id="kode_unik" type="text" class="form-control @error('kode_unik') is-invalid @enderror" name="kode_unik" value="{{ old('kode_unik') }}" required autocomplete="kode_unik" autofocus>

                                @error('kode_unik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Kata Sandi') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Ulang Kata Sandi') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ktm" class="col-md-4 col-form-label text-md-end">Upload KTM (Kartu Tanda Mahasiswa)</label>
                            <div class="col-md-6">
                                <input class="form-control" type="file" name="ktm" id="ktm" />
                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                            </div>
                            @error('ktm')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: 'Registrasi berhasil dilakukan. Tunggu pengecekan data dari koordinator skripsi untuk bisa login sebagai mahasiswa.',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}'; // Ganti dengan URL halaman login yang sesuai
                }
            });
        @endif
    </script>
    {{-- <script>
        @if(isset($script))
            {!! $script !!}
        @endif
    </script> --}}
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Fungsi untuk menampilkan alert dan mengarahkan ke halaman login
    function showSuccessAlert() {
        alert('Selamat!\nRegistrasi berhasil dilakukan, selanjutnya cukup menunggu pengecekan data dari koordinator skripsi untuk bisa login sebagai mahasiswa');
        window.location.href = '/login'; // Ganti '/login' dengan URL halaman login yang sesuai
    }
</script>
