@extends('layout.master3')

@section('title')
Data Mahasiswa
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Data Mahasiswa</h4>
                <p class="card-title-desc">Data mahasiswa dapat dilihat pada tabel dibawah ini, terdapat filter mengenai angkatan mahasiswa dan tombol detailnya.</p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
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
                        @php
                        $no=1;
                        @endphp
                      @foreach($datamhs as $data)
                      <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $data->kode_unik }}</td>
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->dosen_pembimbing_utama ?? 'Tidak Ada' }}</td>
                          <td>
                            @php
                                $progressMahasiswa = 0;
                                $totalDataPart1 = 0;
                                $completedTablesPart1 = 0;

                                // Hitung progress untuk setiap fase pada mahasiswa
                                $totalTablesPart1 = count($tablesPart1);

                                foreach ($tablesPart1 as $table) {
                                    $result = \DB::table($table)->where('users_id', $data->id)->get();
                                    $totalDataPart1 += count($result);

                                    // Periksa apakah hasil query tidak null dan memiliki data
                                    if ($result !== null && count($result) > 0) {
                                        $completedTablesPart1++;
                                    }
                                }

                                $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;

                                $totalTablesPart2 = count($tablesPart2);
                                $totalDataPart2 = 0;
                                $completedTablesPart2 = 0;

                                foreach ($tablesPart2 as $table) {
                                    $result = \DB::table($table)->where('users_id', $data->id)->get();
                                    $totalDataPart2 += count($result);

                                    // Periksa apakah hasil query tidak null dan memiliki data
                                    if ($result !== null && count($result) > 0) {
                                        $completedTablesPart2++;
                                    }
                                }

                                $countRevisiSidang = \DB::table('berita_acara_skripsi')
                                    ->whereNotNull('acc_dospem')
                                    ->whereNotNull('acc_penguji_1')
                                    ->whereNotNull('acc_penguji_2')
                                    ->whereNotNull('acc_penguji_3')
                                    ->where('users_id', Auth::user()->id)
                                    ->count();

                                // dd($countRevisiSidang);

                                if ($countRevisiSidang > 0) {
                                    // Blok ini seharusnya dijalankan jika $countRevisiSidang lebih dari 0
                                    $progressRevisiSidang = 1; // Atur nilai progress tambahan
                                    $tahap = 'selesai';
                                } else {
                                    // Blok ini seharusnya dijalankan jika $countRevisiSidang kurang dari atau sama dengan 0
                                    $progressRevisiSidang = 0;
                                }
                                $totalpart2 = count($tablesPart2);
                                $totalcompleted2 = $totalpart2 + 1;

                                $totaltabelhasil = $totalTablesPart2 + $progressRevisiSidang;

                                $progressPercentagePart2 = ($totaltabelhasil / $totalcompleted2) * 50;
                                // $progressPercentagePart2 = ($completedTablesPart2 / ($tablesPart2)) * 50;
                                // dd($progressPercentagePart2, $totaltabelhasil, $totalcompleted2);


                                $totalData = $totalDataPart1 + $totalDataPart2;
                                $progressMahasiswa = ($totalData / ($totalTablesPart1 + count($tablesPart2))) * 100;
                            @endphp

                            {{-- {{ number_format($progressMahasiswa, 2) }}% --}}
                            @if($progressMahasiswa == 0)
                            <span class="mt-2">Anda belum memulai tahap skripsi</span>
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
                        @elseif($progressMahasiswa > 50 && $progressMahasiswa <= 62.50)
                            <span class="mt-2"><strong>Bimbingan Skripsi</strong></span>
                        @elseif($progressMahasiswa > 62.50 && $progressMahasiswa <= 75)
                            <span class="mt-2"><strong>Sidang Skripsi</strong></span>
                        @elseif($progressMahasiswa > 75.00 && $progressMahasiswa <= 87.50)
                            <span class="mt-2"><strong>Revisi Sidang Skripsi</strong></span>
                        @elseif($progressMahasiswa > 87.50 && $progressMahasiswa <= 100)
                            <span class="mt-2"><strong> Skripsi Telah Selesai</strong></span>
                        @else
                            <span class="mt-2">Selamat, Proses Skripsi Telah Selesai</span>
                        @endif
                        </td>

                          <td>
                              <a href="{{ url('/ketua_jurusan/data_mahasiswa/detail/' . $data->id) }}" class="btn btn-primary">Detail</a>
                          </td>
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
