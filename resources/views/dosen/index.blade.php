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
    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Mahasiswa Bimbingan</h5>
              </div>
              <iconify-icon icon="solar:book-linear"><?php echo $mahasiswaCount ?></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Jadwal Menguji</h5>
              </div>
              <iconify-icon icon="solar:book-linear"><?php echo $s3 ?></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Bidang Ilmu</h5>
              </div>
              <iconify-icon icon="solar:book-linear"><?php echo $BICount ?></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Tema Disetorkan</h5>
              </div>
              <iconify-icon icon="solar:book-linear"></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
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
