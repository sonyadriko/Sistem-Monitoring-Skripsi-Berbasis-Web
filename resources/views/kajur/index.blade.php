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
                    <a href="{{ route('data-mhs') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0" style="color: #000000; font-family: 'Nunito', sans-serif; font-weight: bold;">Mahasiswa</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{$mahasiswaCount }}</h3>
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
                    <a href="{{ route('data-dsn') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0" style="color: #1CC88A; font-family: 'Nunito', sans-serif; font-weight: bold;">Dosen Pembimbing</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{$dosenCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="mdi:user-child" width="36" height="36"></iconify-icon>
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
                    <a href="{{ route('data-bi') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0" style="color: #224ABE; font-family: 'Nunito', sans-serif; font-weight: bold;">Bidang Ilmu</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{$bidangIlmuCount }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="jam:messages-alt" width="36" height="36"></iconify-icon>
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
                    <a href="{{ route('data-jadwal') }}" class="card-link text-reset">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0" style="color: #C22127; font-family: 'Nunito', sans-serif; font-weight: bold;">Jadwal</h6>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 col-md-12 col-xl-7">
                                <h3 class="mb-2">{{$total }}</h3>
                            </div>
                            <div class="col-6 col-md-12 col-xl-5">
                                <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                    <iconify-icon icon="uil:schedule" width="36" height="36"></iconify-icon>
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
