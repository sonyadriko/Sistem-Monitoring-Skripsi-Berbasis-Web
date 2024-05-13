@extends('layout.master3')

@section('title', 'Sidang Skripsi')

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penjadwalan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Sidang Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold">Pengajuan Sidang Skripsi</h4>
                    <p class="card-title-desc">Daftar pengajuan sidang skripsi tersedia di tabel di bawah ini, termasuk
                        tombol detail.</p>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="statusFilter">Filter Status:</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Semua</option>
                                <option value="pending">Pending</option>
                                <option value="terima">Terima</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="tahunFilter">Filter Angkatan:</label>
                            <select id="tahunFilter" class="form-control">
                                <option value="">Semua</option>
                                @foreach ($angkatan as $year)
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
                                <th>Judul</th>
                                <th>Bidang Ilmu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semhas as $index => $semh)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $semh->name }}</td>
                                    <td>{{ $semh->kode_unik }}</td>
                                    <td>{{ implode(' ', array_slice(str_word_count($semh->judul, 1), 0, 6)) }}...</td>
                                    <td>{{ $semh->topik_bidang_ilmu }}</td>
                                    <td>{{ $semh->status }}</td>
                                    <td>
                                        <a href="{{ url('/koordinator/jadwal_sidang_skripsi/detail/' . $semh->id_sidang_skripsi) }}"
                                            class="btn btn-primary">Detail</a>
                                    </td>
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
