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
    <h4 class="mb-3 mb-md-0">Penjadwalan</h4>
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
<h6 class="mb-4">Silahkan memilih tombol dibawah ini untuk membuat jadwal seminar proposal atau sidang skripsi, anda juga dapat melihat jadwal yang telah dibuat sebelumnya.</h6>



<div class="row">
    <div class="col-md-3">
        <a href="{{ route('jadwal-seminar-proposal.index') }}" class="card-link">
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Seminar Proposal</h5>
                            </div>
                            <iconify-icon icon="solar:book-linear">{{$semproCount }}</iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('jadwal-sidang-skripsi.index') }}" class="card-link">
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Sidang Skripsi</h5>
                            </div>
                            <iconify-icon icon="solar:book-linear"> {{$semhasCount}}</iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    {{-- <div class="col-md-3">
        <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                <h5 class="text-nowrap mb-2">Jadwal Dibuat</h5>
                </div>
                <iconify-icon icon="solar:book-linear">{{$jadwalCount}}</iconify-icon>
            </div>
            </div>
        </div>
        </div>
    </div> --}}
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
