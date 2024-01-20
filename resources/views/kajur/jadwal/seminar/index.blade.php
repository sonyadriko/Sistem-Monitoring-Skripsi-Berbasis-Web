@extends('layout.master3')

@section('title')
Sidang Proposal
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
      <li class="breadcrumb-item"><a href="#">Daftar Jadwal</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sidang Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Data Sidang Proposal</h4>
                <p class="card-title-desc">List pengajuan sidang proposal dapat dilihat pada tabel dibawah ini, dan juga terdapat tombol detailnya.
                </p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Mahasiswa</th>
                        <th>Dosen Penguji</th>
                        <th>Ruangan</th>
                        <th>Hari</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($sempros as $semp)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $semp->kode_unik }}</td>
                            <td>{{ $semp->name }}</td>
                            <td>{{ $semp->nama_penguji_1 ?? 'Belum diatur' }}</td>
                            <td>{{ $semp->nama_ruangan ?? 'Belum diatur' }}</td>
                            @php
                                $formatTanggal = null;
                                if(!is_null($semp->tanggal)) {
                                    $carbonTanggal = \Carbon\Carbon::parse($semp->tanggal);
                                    $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                }
                            @endphp
                            <td>{{ $formatTanggal ?? 'Belum diatur' }}</td>
                            {{-- <td>{{ $semp->tanggal ?? 'Belum diatur' }}</td> --}}
                            <td><a href="{{ url('/ketua_jurusan/seminar/detail/' . $semp->id_seminar_proposal) }}" class="btn btn-primary">Detail</a></td>
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
