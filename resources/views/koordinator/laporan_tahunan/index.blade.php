@extends('layout.master3')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Laporan Tahunan
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Laporan Tahunan</h4>
  </div>
</div>
<h6 class="mb-4">Laporan tahunan dapat direkap dan digenerate oleh koordinator.</h6>



<div class="row">
    <div class="col-md-3">
        {{-- <a href="{{ route('data-pengguna-mhs.index') }}" class="card-link"> --}}
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title">
                            <h5 class="text-nowrap mb-2">Sidang Proposal</h5>
                        </div>
                        <iconify-icon icon="solar:book-linear">{{$semproCount }}</iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        {{-- </a> --}}
    </div>

    <div class="col-md-3">
        {{-- <a href="{{ route('data-pengguna-dosen.index') }}" class="card-link"> --}}
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title">
                            <h5 class="text-nowrap mb-2">Sidang Skripsi</h5>
                        </div>
                        <iconify-icon icon="solar:book-linear">{{$semhasCount}}</iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        {{-- </a> --}}
    </div>

    <div class="col-md-3">
        {{-- <a href="{{ route('data-pengguna-kajur.index') }}" class="card-link"> --}}
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title">
                            <h5 class="text-nowrap mb-2">Manajemen Pengguna</h5>
                        </div>
                        <iconify-icon icon="solar:book-linear">{{$userCount}}</iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        {{-- </a> --}}
    </div>
    <div class="col-md-3">
        {{-- <a href="{{ route('data-pengguna-kajur.index') }}" class="card-link"> --}}
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title">
                            <h5 class="text-nowrap mb-2">Berita Acara</h5>
                        </div>
                        <iconify-icon icon="solar:book-linear">{{$totalBA}}</iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        {{-- </a> --}}
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
