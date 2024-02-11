@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
History Revisi Sidang
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">History Revisi Sidang Skripsi</h4>
  </div>
</div>
<h6 class="mb-4">Seluruh informasi mengenai history revisi sidang skripsi akan ditampilkan dibawah ini.</h6>


<div class="row">
<div class="container-xxl flex-grow-1 container-p-y">

<div class="card mb-4">
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>Bimbingan</th>
                  <th>Tanggal</th>
                  <th>Revisi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
                @endphp
                @foreach($hisbimmhs as $hbmhs)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ \Carbon\Carbon::parse($hbmhs->created_at)->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $hbmhs->revisi }}</td>
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
                    <td style="text-transform: capitalize;">{{ $hbmhs->name }}</td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td style="text-transform: capitalize;">{{ $hbmhs->judul }}</td>
                </tr>
                <tr>
                    <td>Bidang Ilmu</td>
                    <td style="text-transform: capitalize;">{{ $hbmhs->topik_bidang_ilmu }}</td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing Utama</td>
                    <td style="text-transform: capitalize;">{{ $hbmhs->dosen_pembimbing_utama }}</td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing II</td>
                    <td style="text-transform: capitalize;">{{ $hbmhs->dosen_pembimbing_ii }}</td>
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


