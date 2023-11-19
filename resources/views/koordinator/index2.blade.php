@extends('layouts/template')

@section('title')
Dashboard - Koordinator
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="row">
    <div class="col-md-3">
      <div class="card mb-4">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Mahasiswa</h5>
              </div>
              <iconify-icon icon="solar:book-linear">{{$mahasiswaCount }}</iconify-icon>
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
                <h5 class="text-nowrap mb-2">Dosen Pembimbing</h5>
              </div>
              <iconify-icon icon="solar:book-linear"> {{$dosenCount}}</iconify-icon>
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
                <h5 class="text-nowrap mb-2">Pengajuan Masuk</h5>
              </div>
              <iconify-icon icon="solar:book-linear">{{$pengajuanCount}}</iconify-icon>
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
                <h5 class="text-nowrap mb-2">Jadwal Dibuat</h5>
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
</div>
@endsection
