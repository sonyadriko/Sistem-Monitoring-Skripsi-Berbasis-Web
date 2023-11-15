@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">History Bimbingan Proposal</h4>
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
<h6 class="mb-4">Seluruh informasi mengenai history bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6>


<div class="row">
<div class="container-xxl flex-grow-1 container-p-y">

<div class="card mb-4">
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Bimbingan</th>
                  <th>File</th>
                  {{-- <th>Validasi Revisi</th> --}}
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
                @endphp
                @foreach($hisbimmhs as $hbmhs)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $hbmhs->created_at }}</td>
                    <td>{{ $no }}</td>
                    <td>
                        <a href="{{ asset($hbmhs->file) }}" class="btn btn-primary" target="_blank">Cek File</a>
                    </td>
                    <td>{{ $hbmhs->validasi ?? 'belum acc' }}</td>

                    {{-- <td><a href="{{ url('/mahasiswa/history_bimbingan_proposal/detail/' . $hbmhs->id_detail_bimbingan_proposal) }}" class="btn btn-primary">Detail</a></td> --}}
                </tr>
                @php
                $no++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="card mb-4">
<h5 class="card-header">Data Mahasiswa dan Dosen Pembimbing</h5>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                @foreach($hisbimmhs as $hbmhs)
                <tr>
                    <td>NPM</td>
                    <td>{{ $hbmhs->kode_unik }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>{{ $hbmhs->name }}</td>
                </tr>
                <tr>
                    <td>Bidang Ilmu</td>
                    <td>{{ $hbmhs->topik_bidang_ilmu }}</td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing Utama</td>
                    <td>{{ $hbmhs->dosen_pembimbing_utama }}</td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing II</td>
                    <td>{{ $hbmhs->dosen_pembimbing_ii }}</td>
                </tr>
                @break
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>

{{-- !-- row --> --}}
@endsection


