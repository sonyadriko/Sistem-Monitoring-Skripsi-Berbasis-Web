@extends('layout.master3')

@section('title', 'Revisi Sidang Proposal')

@section('css')
<!-- Menghubungkan stylesheet untuk DataTables -->
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Menampilkan pesan sukses -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Breadcrumb untuk navigasi halaman -->
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Revisi Sidang Proposal</li>
    </ol>
</nav>
<!-- Tabel untuk menampilkan data revisi mahasiswa -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Revisi Mahasiswa Sidang Proposal</h4>
                <p class="card-title-desc">Tabel berikut merupakan list mahasiswa yang telah melakukan sidang dan masih memerlukan revisi pada proposalnya</p>
            </div>
            <div class="card-body table-responsive">
                <!-- Filter untuk tabel -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="tahunFilter">Filter Angkatan:</label>
                        <select id="tahunFilter" class="form-control">
                            <option value="">Semua</option>
                            @foreach($angkatan as $year)
                                <option value="{{ $year->nama_angkatan }}">{{ $year->nama_angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="statusFilter">Filter Sebagai:</label>
                        <select id="statusFilter" class="form-control">
                            <option value="">Semua</option>
                            <option value="Dosen Penguji 1">Dosen Penguji 1</option>
                            <option value="Dosen Penguji 2">Dosen Penguji 2</option>
                            <option value="Dosen Pembimbing">Dosen Pembimbing</option>
                        </select>
                    </div>
                </div>
                <!-- Tabel data mahasiswa -->
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Judul</th>
                        <th>Bidang Ilmu</th>
                        <th>Sebagai</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($rev as $index => $dosen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dosen->name }}</td>
                            <td>{{ $dosen->kode_unik }}</td>
                            <td>{{ Str::words($dosen->judul, 6, '...') }}</td>
                            <td>{{ $dosen->topik_bidang_ilmu }}</td>
                            <td>
                                <!-- Menentukan peran dosen berdasarkan data -->
                                @if($dosen->dosen_pembimbing_utama == Auth::user()->name)
                                    Dosen Pembimbing
                                @elseif($dosen->dosen_penguji_1 == Auth::user()->id)
                                    Dosen Penguji 1
                                @elseif($dosen->dosen_penguji_2 == Auth::user()->id)
                                    Dosen Penguji 2
                                @else
                                    Tidak Diketahui
                                @endif
                            </td>
                            <td><a href="{{ url('/dosen/revisi_seminar_proposal/detail/' . $dosen->id_revisi_seminar_proposal) }}" class="btn btn-primary">Cek Revisi</a></td>
                        </tr>
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
<!-- Script untuk menginisialisasi DataTables -->
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
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable();
        $('#statusFilter').change(function() {
            table.column(5).search(this.value).draw();
        });
        $('#tahunFilter').change(function() {
            table.column(2).search(this.value).draw();
        });
    });
</script>
@endsection
