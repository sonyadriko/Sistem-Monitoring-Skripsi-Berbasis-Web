@extends('layout.master')

@push('plugin-styles')
    <!-- Link to Flatpickr CSS for date picking functionality -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Penjadwalan')

@section('content')
    <!-- Success message display block -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Breadcrumb navigation -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Jadwal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal</li>
        </ol>
    </nav>
    <!-- Page title and introduction text -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0" style="color: #000; font-weight: bold">Daftar Jadwal</h4>
    </div>
    <h6 class="mb-4">Silahkan memilih tombol dibawah ini untuk melihat data sidang proposal atau sidang skripsi, anda juga
        dapat melihat jadwal yang telah dibuat sebelumnya.</h6>
    <!-- Cards for seminar and thesis session data -->
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Link to seminar data -->
                    <a href="{{ route('data-seminar') }}" class="text-decoration-none text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0"
                                style="color: #224ABE; font-family: 'Nunito', sans-serif; font-weight: bold;">Sidang
                                Proposal</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $semproCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <!-- Icon for seminar -->
                                    <iconify-icon icon="mdi:book-open-outline" width="36" height="36"></iconify-icon>
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
                    <!-- Link to thesis session data -->
                    <a href="{{ route('data-sidang') }}" class="text-decoration-none text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0"
                                style="color: #1CC88A; font-family: 'Nunito', sans-serif; font-weight: bold;">Sidang Skripsi
                            </h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $semhasCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="mdi:book-check-outline" width="36"
                                        height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
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
