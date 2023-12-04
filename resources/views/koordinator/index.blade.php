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

  {{-- <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
      <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
    </div>
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button>
  </div> --}}
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



  {{-- <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Info Penting</h5>
        </div>
        <div class="card-body text-center">
          <img src="img/illustrations/info_img.png" alt="Gambar Info Penting" class="img-fluid">
          <p>Dosen Pembimbing dapat melakukan input Topik/Tema penelitian, yang nantinya dapat diambil oleh calon mahasiswa bimbingan untuk diajukan sebagai proposal skripsi.</p>
        </div>
      </div>
    </div>
  </div> --}}


{{-- !-- row --> --}}
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
