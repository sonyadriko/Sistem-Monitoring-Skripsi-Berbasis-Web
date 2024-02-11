@extends('layout.master3')

@section('title')
Bimbingan Proposal
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
      <li class="breadcrumb-item active" aria-current="page">Proposal Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Mahasiswa Bimbingan Proposal</h4>
                <p class="card-title-desc">Mahasiswa bimbingan anda, akan muncul dibawah ini.</p>
            </div>
            <div class="card-body table-responsive">
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
                </div>
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
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
                        @php
                        $no=1;
                        @endphp
                        @foreach($bimbinganp as $dosen)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $dosen->name }}</td>
                            <td>{{ $dosen->kode_unik }}</td>
                            {{-- <td>{{ $dosen->judul }}</td> --}}
                            <td>{{ implode(' ', array_slice(str_word_count($dosen->judul, 1), 0, 6)) }}...</td>
                            <td>{{ $dosen->topik_bidang_ilmu }}</td>
                            <td>
                                @if($dosen->dosen_pembimbing_utama == Auth::user()->name)
                                    Dosen Pembimbing Utama
                                @elseif($dosen->dosen_pembimbing_ii == Auth::user()->name)
                                    Dosen Pembimbing II
                                @else
                                    Tidak Diketahui
                                @endif
                            </td>
                            <td><a href="{{ url('/dosen/bimbingan_proposal/detail/' . $dosen->id_bimbingan_proposal) }}" class="btn btn-primary">Detail</a></td>
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
<script>
    $(document).ready(function() {
        // Periksa apakah DataTable sudah diinisialisasi sebelumnya
        if ($.fn.DataTable.isDataTable('#datatable')) {
            // Hancurkan DataTable sebelum menginisialisasi ulang
            $('#datatable').DataTable().destroy();
        }

        // Inisialisasi DataTable
        var table = $('#datatable').DataTable({
            // ... (pengaturan DataTable lainnya) ...
        });

        // Handle perubahan filter status
        $('#statusFilter').change(function() {
            var status = $(this).val();
            table.column(5).search(status).draw(); // Sesuaikan dengan indeks kolom yang benar
        });

        $('#tahunFilter').change(function() {
            var tahun = $(this).val();
            table.column(2).search(tahun).draw(); // Sesuaikan dengan indeks kolom yang berisi NPM
        });
    });
</script>
@endsection
