@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-4 col-lg-8 col-xl-4">
        <div class="card mb-4">
          <div class="card-body p-3">
            <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Semester</h5>
                </div>
                <iconify-icon icon="solar:book-linear"></iconify-icon>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-8 col-xl-4">
        <div class="card mb-4">
          <div class="card-body p-3">
            <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Jumlah SKS</h5>
                </div>
                <iconify-icon icon="solar:book-linear"></iconify-icon>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-8 col-xl-4">
        <div class="card mb-4">
          <div class="card-body p-3">
            <div class="d-flex justify-content-between flex-row flex-sm-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Pengajuan dilakukan</h5>
                </div>
                <iconify-icon icon="solar:book-linear"></iconify-icon>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- similar columns here -->
  
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="card-header m-0 me-2 pb-3">Info Penting</h5>
            </div>
            <div class="col-md-4 p-3">
              <p>Pengajuan proposal skripsi hanya dapat dilakukan oleh mahasiswa yang sudah melewati semester 6, dan sudah menempuh mata kuliah yang akan dijadikan sebagai topik proposal skripsi</p>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </div>
  
  @endsection