@extends('layout.master')

@section('title')
Detail Berita Acara Proposal
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
      <li class="breadcrumb-item active" aria-current="page">BA Seminar Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Seminar Proposal</h5>
            {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
            <div class="card-body">
                <div class="card-datatable table-responsive  pt-0">
                <table class="table table-borderless datatables-basicd border-top"/>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>NPM</td>
                            <td>{{$data->kode_unik}}</td>
                            <td>No. Ujian</td>
                            <td>{{$data->id_berita_acara_p}}</td>
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
                            <td>Tema / Judul</td>
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
                                {{$data->nama_penguji_2}}
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Review Dosen Pembimbing</h5>
            <form action="{{route('berita-acara-proposal.store')}}" method="POST" id="reviewForm">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="revisi" class="form-label">Revisi</label>
                        <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Ujian</label>
                        <input
                        type="number"
                        class="form-control"
                        name="nilai"
                        id="nilai"
                        placeholder="Masukan Nilai Ujian..."
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <input type="hidden" name="berita_acara_proposal_id" value="{{$data->id_berita_acara_p}}"/>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
