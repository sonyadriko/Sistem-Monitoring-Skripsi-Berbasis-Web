@extends('layout.master3')

@section('title', 'Jadwal Menguji')

@section('css')
    <!-- Menghubungkan dengan CSS untuk DataTables -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Breadcrumb untuk navigasi halaman -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal</li>
        </ol>
    </nav>
    <!-- Tabel untuk menampilkan jadwal sidang -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold">Tabel List Sidang Proposal & Sidang Skripsi</h4>
                    <p class="card-title-desc">List sidang proposal dan skripsi dapat dilihat pada tabel dibawah ini, dan
                        juga terdapat tombol detailnya.</p>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <!-- Dropdown untuk filter status sidang -->
                            <label for="statusFilter">Filter Status:</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Semua</option>
                                <option value="proposal">Proposal</option>
                                <option value="skripsi">Skripsi</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tabel yang menampilkan data sidang -->
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sidang</th>
                                <th>Jadwal</th>
                                <th>Ruang & Waktu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data jadwal sidang -->
                            @foreach ($uniqueJadwal as $index => $jadwal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwal->jenis_sidang }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->isoFormat('dddd, D MMMM Y', 'id') }}
                                    </td>
                                    <td>{{ $jadwal->nama_ruangan }}, {{ $jadwal->jam }}</td>
                                    <td><a href="{{ url('/dosen/jadwal_menguji/detailjadwal/' . $jadwal->tanggal) }}"
                                            class="btn btn-primary">Detail</a></td>
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
    <!-- Menghubungkan dengan JavaScript untuk DataTables -->
    <script src="{{ asset('assets2/libs/datatables.net/datatables.net.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
    <script src="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
    <script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
    <script>
        // Inisialisasi DataTable dan fungsi filter
        $(document).ready(function() {
            var table = $('#datatable').DataTable();
            $('#statusFilter').change(function() {
                table.column(1).search(this.value).draw();
            });
        });
    </script>
@endsection
