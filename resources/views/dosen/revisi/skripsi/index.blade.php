@extends('layout.master3')

@section('title')
Revisi Sidang Skripsi
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Revisi Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Revisi Mahasiswa Sidang Skripsi</h4>
                <p class="card-title-desc">Tabel berikut merupakan list mahasiswa yang telah melakukan sidang dan masih memerlukan revisi pada skripsinya.</code>.
                </p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Judul</th>
                        <th>Bidang Ilmu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($rev as $dosen)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $dosen->name }}</td>
                            <td>{{ $dosen->kode_unik }}</td>
                            <td style="word-wrap: break-word;">{{ $dosen->judul }}</td>
                            {{-- <td style="word-wrap: break-word;">{{ implode(' ', array_slice(str_word_count($dosen->judul, 1), 0, 8)) }}...</td> --}}
                            {{-- <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                @php
                                    $judulWords = str_word_count($dosen->judul, 1);
                                    $chunks = array_chunk($judulWords, 6);
                                @endphp
                                @foreach ($chunks as $chunk)
                                    <div>{{ implode(' ', $chunk) }}</div>
                                @endforeach
                            </td> --}}

                            <td>{{ $dosen->topik_bidang_ilmu }}</td>
                            <td><a href="{{ url('/dosen/revisi_sidang_skripsi/detail/' . $dosen->id_revisi_sidang_skripsi) }}" class="btn btn-primary">Cek Revisi</a></td>
                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
<script src="{{ asset('assets2/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets2/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets2/js/app.min.js') }}"></script>
@endsection
