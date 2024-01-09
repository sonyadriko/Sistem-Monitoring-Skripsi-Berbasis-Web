@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Dashboard
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>

</div>
<h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi</h6>



<div class="row">
    <div class="row flex-grow-1">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Mahasiswa</h6>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-xl-7">
                            <h3 class="mb-2">{{$mahasiswaCount }}</h3>
                        </div>
                        <div class="col-6 col-md-12 col-xl-5">
                            <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                <iconify-icon icon="mdi:users" width="36" height="36"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Dosen Pembimbing</h6>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-xl-7">
                            <h3 class="mb-2">{{$dosenCount }}</h3>
                        </div>
                        <div class="col-6 col-md-12 col-xl-5">
                            <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                <iconify-icon icon="mingcute:task-2-fill" width="36" height="36"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Pengajuan Masuk</h6>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-xl-7">
                            <h3 class="mb-2">{{$pengajuanCount }}</h3>
                        </div>
                        <div class="col-6 col-md-12 col-xl-5">
                            <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                <iconify-icon icon="bxs:message" width="36" height="36"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Jadwal Dibuat</h6>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-12 col-xl-7">
                            <h3 class="mb-2">{{$pengajuanCount }}</h3>
                        </div>
                        <div class="col-6 col-md-12 col-xl-5">
                            <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                <iconify-icon icon="uis:calender" width="36" height="36"></iconify-icon>
                            </div>
                        </div>
                    </div>
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
