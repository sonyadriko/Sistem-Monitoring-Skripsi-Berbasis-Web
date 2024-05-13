@extends('layout.master3')

@section('title', 'Data Mahasiswa')

@section('css')
    <!-- Linking CSS files for DataTables -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Breadcrumb for navigation -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
        </ol>
    </nav>

    <!-- Main content area -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold">Data Mahasiswa</h4>
                    <p class="card-title-desc">Data mahasiswa dapat dilihat pada tabel dibawah ini, terdapat filter mengenai
                        angkatan mahasiswa dan tombol detailnya.</p>
                </div>
                <div class="card-body table-responsive">
                    <!-- Filter for batch year -->
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
                    <!-- DataTable for displaying student data -->
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Dosen Pembimbing</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datamhs as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->kode_unik }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->dosen_pembimbing_utama ?? 'Tidak Ada' }}</td>
                                    <td>
                                        @php
                                            // Calculate student progress in thesis phases
                                            $progressMahasiswa = 0;
                                            $totalDataPart1 = 0;
                                            $completedTablesPart1 = 0;

                                            // Calculate progress for each phase for the student
                                            $totalTablesPart1 = count($tablesPart1);
                                            $completedTablesPart1 = 0;
                                            foreach ($tablesPart1 as $table) {
                                                $result = \DB::table($table)
                                                    ->where('users_id', $data->id)
                                                    ->get();
                                                $totalDataPart1 += count($result);

                                                // Check if the query result is not null and has data
                                                if ($result !== null && count($result) > 0) {
                                                    $completedTablesPart1++;
                                                }
                                            }

                                            $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;
                                            $totalTablesPart2 = count($tablesPart2);
                                            $totalDataPart2 = 0;
                                            $completedTablesPart2 = 0;
                                            foreach ($tablesPart2 as $table) {
                                                $result = \DB::table($table)
                                                    ->where('users_id', $data->id)
                                                    ->get();
                                                $totalDataPart2 += count($result);
                                                // Check if the query result is not null and has data
                                                if ($result !== null && count($result) > 0) {
                                                    $completedTablesPart2++;
                                                }
                                            }
                                            $tahap = '';
                                            $countRevisiSidang = \DB::table('berita_acara_skripsi')
                                                ->whereNotNull('acc_dospem')
                                                ->whereNotNull('acc_penguji_1')
                                                ->whereNotNull('acc_penguji_2')
                                                ->whereNotNull('acc_penguji_3')
                                                ->where('users_id', $data->id)
                                                ->count();
                                            if ($countRevisiSidang > 0) {
                                                // This block should run if $countRevisiSidang is more than 0
                                                $progressRevisiSidang = 1; // Set additional progress value
                                                $tahap = 'selesai';
                                            } else {
                                                // This block should run if $countRevisiSidang is less than or equal to 0
                                                $progressRevisiSidang = 0;
                                            }
                                            $totalpart2 = count($tablesPart2);
                                            $totalcompleted2 = $totalpart2 + 1;
                                            $totaltabelhasil = $completedTablesPart2 + $progressRevisiSidang;
                                            $progressPercentagePart2 = ($totaltabelhasil / $totalcompleted2) * 50;
                                            $proses1 = ($completedTablesPart1 / $totalTablesPart1) * 50;
                                            $proses2 = ($totaltabelhasil / $totalcompleted2) * 50;
                                            $hasilprogress = $proses1 + $proses2;
                                            $progressMahasiswa = number_format($hasilprogress, 2);
                                        @endphp
                                        <!-- Display progress with conditional formatting -->
                                        @if ($progressMahasiswa == 0)
                                            <span class="mt-2">Belum memulai tahap skripsi</span>
                                        @elseif($progressMahasiswa > 0 && $progressMahasiswa <= 10)
                                            <span class="mt-2"><strong> Pengajuan Judul</strong></span>
                                        @elseif($progressMahasiswa > 10 && $progressMahasiswa <= 20)
                                            <span class="mt-2"><strong> Bimbingan Proposal</strong></span>
                                        @elseif($progressMahasiswa > 20 && $progressMahasiswa <= 30)
                                            <span class="mt-2"><strong>Sidang Proposal</strong></span>
                                        @elseif($progressMahasiswa > 30 && $progressMahasiswa <= 40)
                                            <span class="mt-2"><strong>Revisi Sidang Proposal</strong></span>
                                        @elseif($progressMahasiswa > 40 && $progressMahasiswa <= 50)
                                            <span class="mt-2"><strong>Surat Tugas</strong></span>
                                        @elseif($progressMahasiswa > 50 && $progressMahasiswa <= 62.5)
                                            <span class="mt-2"><strong>Bimbingan Skripsi</strong></span>
                                        @elseif($progressMahasiswa > 62.5 && $progressMahasiswa <= 75)
                                            <span class="mt-2"><strong>Sidang Skripsi</strong></span>
                                        @elseif($progressMahasiswa > 75.0 && $progressMahasiswa <= 87.5)
                                            <span class="mt-2"><strong>Revisi Sidang Skripsi</strong></span>
                                        @elseif($progressMahasiswa > 87.5 && $progressMahasiswa <= 100)
                                            <span class="mt-2"><strong> Skripsi Telah Selesai</strong></span>
                                        @else
                                            <span class="mt-2">Skripsi Telah Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button to trigger detail modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detailModal{{ $data->id }}">Detail</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Include modals for each student -->
    @foreach ($datamhs as $data)
        @include('components.mahasiswa_detail_modal', ['data' => $data])
    @endforeach

@endsection

@push('plugin-scripts')
    <!-- Scripts for modal and chart functionalities -->
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Manually initialize modals for each modal ID
            @foreach ($datamhs as $data)
                $('#detailModal{{ $data->id }}').modal({
                    show: false,
                    backdrop: 'static',
                    keyboard: false
                });
            @endforeach
        });
    </script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- DataTables scripts -->
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
            // Check if DataTable is already initialized
            if ($.fn.DataTable.isDataTable('#datatable')) {
                // Destroy DataTable before reinitializing
                $('#datatable').DataTable().destroy();
            }

            // Initialize DataTable
            var table = $('#datatable').DataTable({
                // ... (other DataTable settings) ...
            });

            // Handle changes in status filter
            $('#statusFilter').change(function() {
                var status = $(this).val();
                table.column(5).search(status).draw(); // Adjust according to the correct column index
            });

            $('#tahunFilter').change(function() {
                var tahun = $(this).val();
                table.column(1).search(tahun).draw(); // Adjust according to the column index containing NPM
            });
        });
    </script>
@endsection
