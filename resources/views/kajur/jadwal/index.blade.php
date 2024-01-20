@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Penjadwalan
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Daftar Jadwal</h4>
    </div>
</div>
<h6 class="mb-4">Silahkan memilih tombol dibawah ini untuk melihat data sidang proposal atau sidang skripsi, anda juga dapat melihat jadwal yang telah dibuat sebelumnya.</h6>

<div class="row">
    <div class="row flex-grow-1">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('data-seminar') }}" class="text-decoration-none">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Sidang Proposal</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $semproCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="bxs:message" width="36" height="36"></iconify-icon>
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
                    <a href="{{ route('data-sidang') }}" class="text-decoration-none">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Sidang Skripsi</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{ $semhasCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="mingcute:task-2-fill" width="36" height="36"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- !-- row --> --}}
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
