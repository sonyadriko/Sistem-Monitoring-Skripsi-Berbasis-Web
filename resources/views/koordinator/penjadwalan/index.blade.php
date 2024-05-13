@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Penjadwalan')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0">Penjadwalan</h4>
    </div>
    <h6 class="mb-4">Silahkan memilih tombol dibawah ini untuk membuat jadwal sidang proposal atau sidang skripsi, anda
        juga dapat melihat jadwal yang telah dibuat sebelumnya.</h6>

    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('jadwal-seminar-proposal.index') }}" class="text-decoration-none text-reset">
                        <h6 class="card-title mb-0" style="color: #224ABE">Sidang Proposal</h6>
                        <div class="row mt-2">
                            <div class="col-12 col-xl-7">
                                <h3 class="mb-2">{{ $semproCount }}</h3>
                            </div>
                            <div class="col-12 col-xl-5">
                                <div class="d-flex justify-content-end">
                                    <iconify-icon icon="mdi:book-open-variant" width="36" height="36"></iconify-icon>
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
                    <a href="{{ route('jadwal-sidang-skripsi.index') }}" class="text-decoration-none text-reset">
                        <h6 class="card-title mb-0" style="color: #1CC88A">Sidang Skripsi</h6>
                        <div class="row mt-2">
                            <div class="col-12 col-xl-7">
                                <h3 class="mb-2">{{ $semhasCount }}</h3>
                            </div>
                            <div class="col-12 col-xl-5">
                                <div class="d-flex justify-content-end">
                                    <iconify-icon icon="mdi:book-open-variant" width="36" height="36"></iconify-icon>
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
