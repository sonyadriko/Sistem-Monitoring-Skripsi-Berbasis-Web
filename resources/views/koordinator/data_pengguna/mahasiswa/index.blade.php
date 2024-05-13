@extends('layout.master3')

@section('title', 'Data Mahasiswa')

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold">Manajemen Data Mahasiswa</h4>
                    <p class="card-title-desc">Berikut adalah tabel data mahasiswa yang mencakup filter angkatan dan tombol
                        detail.</p>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
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
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Dosen Pembimbing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->kode_unik }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        @if (!empty($data->judul))
                                            {{ implode(' ', array_slice(str_word_count($data->judul, 1), 0, 6)) }}...
                                        @else
                                            Belum Mengajukan
                                        @endif
                                    </td>
                                    <td>{{ $data->dosen_pembimbing_utama ?? 'Belum Mengajukan' }}</td>
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
                table.column(1).search(tahun).draw(); // Sesuaikan dengan indeks kolom yang berisi NPM
            });
        });
    </script>
@endsection
