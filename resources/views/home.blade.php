@extends('layouts/template')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif

  <div class="row">
    <!-- Proposal Skripsi Card -->
    <div class="col-md-4 col-lg-8 col-xl-4">
      <div class="col-9 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Proposal Skripsi</h5>
                </div>
                <iconify-icon icon="solar:book-linear"></iconify-icon>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Skripsi Card -->
    <div class="col-md-4 col-lg-8 col-xl-4">
      <div class="col-9 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Skripsi</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @endsection