@extends('layout.master')

@section('title')
Detail Berita Acara Sidang Skripsi
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
      <li class="breadcrumb-item active" aria-current="page">BA Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Sidang Skripsi</h5>
            {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
            <div class="card-body">
                <div class="card-datatable table-responsive  pt-0">
                <table class="table table-borderless datatables-basicd border-top"/>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>NPM</td>
                            <td>{{$data->kode_unik}}</td>
                            {{-- <td>Hari Tanggal</td>
                            <td>Senin, 7 Agustus 2023</td> --}}
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$data->name}}</td>
                            @php
                            $dateFromDatabase = $data->tanggal;
                            $formattedDate = date('d F Y', strtotime($dateFromDatabase));
                            // echo $formattedDate; // Hasil: 28 Juni 2021

                            @endphp
                            <td>Hari Tanggal</td>
                            <td>{{$formattedDate}}</td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>{{$data->topik_bidang_ilmu}}</td>
                            <td>Ruang, Waktu</td>
                            <td>{{$data->nama_ruangan}}, {{$data->jam}}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pembimbing 1</td>
                            <td>{{$data->dosen_pembimbing_utama}}</td>
                            <td>Dosen Pembimbing 2</td>
                            <td>{{$data->dosen_pembimbing_ii}}</td>
                        </tr>
                        <tr>
                            <td>Dosen Penguji</td>
                            <td>{{$data->nama_penguji_1}}<br/>
                                {{$data->nama_penguji_2}}<br/>
                                {{$data->nama_penguji_3}}

                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Review Dosen Pembimbing</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Revisi</th>
                              <th>Nilai</th>
                              {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach($bad as $bad)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $bad->name }}</td>
                                <td>{{ $bad->revisi }}</td>
                                <td>{{ $bad->nilai }}</td>
                                {{-- <td><a href="{{ url('/koordinator/berita_acara_proposal/detail/' . $bad->id_detail_berita_acara_p) }}" class="btn btn-primary">Cetak</a></td>  --}}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

