@extends('layout.master3')

@section('title', 'Berita Acara Sidang Skripsi')

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
      <li class="breadcrumb-item"><a href="#">Lain-lain</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sekretaris</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Tabel Sekretaris</h4>
                <p class="card-title-desc">Jadwal Sidang Skripsi sebagai sekretaris dapat dilihat pada tabel dibawah ini.</code>.
                </p>
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
                        @foreach($baskripsi as $index => $ba)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ba->name }}</td>
                            <td>{{ $ba->kode_unik }}</td>
                            <td>{{ $ba->nama_ruangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($ba->tanggal)->isoFormat('dddd, D MMMM Y', 'id') }}</td>
                            <td><a href="{{ url('/dosen/sekretaris/detail/'.$ba->id_berita_acara_s) }}" class="btn btn-primary">Detail</a></td>
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
        $('#tahunFilter').change(function() {
            table.column(2).search($(this).val()).draw();
        });
    });
</script>
@endsection

