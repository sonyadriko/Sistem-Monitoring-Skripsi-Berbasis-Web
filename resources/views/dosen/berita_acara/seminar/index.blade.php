@extends('layout.master3')

@section('title', 'Berita Acara Sidang Proposal')

@section('css')
<!-- Menghubungkan stylesheet untuk DataTables dan komponen-komponen terkait -->
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Breadcrumb untuk navigasi -->
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sidang Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- Judul dan deskripsi halaman -->
                <h4 class="card-title" style="font-weight: bold">Tabel Berita Acara Sidang Proposal</h4>
                <p class="card-title-desc">Jadwal Sidang Proposal sebagai dosen penguji dapat dilihat pada tabel dibawah ini.</p>
            </div>
            <div class="card-body table-responsive">
                <div class="row mb-3">
                    <div class="col-md-2">
                        <!-- Dropdown untuk filter berdasarkan angkatan -->
                        <label for="tahunFilter">Filter Angkatan:</label>
                        <select id="tahunFilter" class="form-control">
                            <option value="">Semua</option>
                            @foreach($angkatan as $year)
                                <option value="{{ $year->nama_angkatan }}">{{ $year->nama_angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Tabel yang menampilkan data berita acara sidang proposal -->
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Ruang</th>
                        <th>Hari</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($ba as $index => $ba)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ba->name }}</td>
                            <td>{{ $ba->kode_unik }}</td>
                            <td>{{ $ba->nama_ruangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($ba->tanggal)->isoFormat('dddd, D MMMM Y', 'id') }}</td>
                            <td><a href="{{ route('berita-acara-proposal.detail', $ba->id_berita_acara_p) }}" class="btn btn-primary">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<!-- Script untuk plugin yang digunakan pada halaman ini -->
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
<!-- Script khusus untuk halaman dashboard -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
<!-- Script untuk menginisialisasi DataTables dan fungsi filter -->
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
    // Fungsi untuk filter berdasarkan angkatan pada tabel
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#datatable')) {
            // Hancurkan DataTable sebelum menginisialisasi ulang
            $('#datatable').DataTable().destroy();
        }

        // Inisialisasi DataTable
        var table = $('#datatable').DataTable({
            // ... (pengaturan DataTable lainnya) ...
        });
        $('#tahunFilter').change(function() {
            table.column(2).search($(this).val()).draw();
        });
    });
</script>
@endsection
