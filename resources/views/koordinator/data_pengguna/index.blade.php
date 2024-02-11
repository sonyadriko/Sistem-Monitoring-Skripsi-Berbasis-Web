@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Data Pengguna
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Manajemen Data Pengguna</h4>
  </div>
</div>
<h6 class="mb-4">Data pengguna dapat dilihat dibawah ini.</h6>


<div class="row">
    <div class="row flex-grow-1">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('data-pengguna-mhs.index') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Mahasiswa</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $mahasiswaCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="ph:student" width="36" height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('data-pengguna-dosen.index') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Dosen</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $dosenCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="ph:chalkboard-teacher" width="36" height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('data-pengguna-kajur.index') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Ketua Jurusan</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $kajurCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="ph:users" width="36" height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('data-pengguna-penggunabaru.index') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Registrasi User</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $newUserCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="ci:user-check" width="36" height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
