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
                                $completedTablesPart1 = 0;
                                foreach ($tablesPart1 as $table) {
                                    $result = \DB::table($table)->where('users_id', $data->id)->get();
                                    $totalDataPart1 += count($result);

                                    // Periksa apakah hasil query tidak null dan memiliki data
                                    if ($result !== null && count($result) > 0) {
                                        $completedTablesPart1++;
                                    }
                                }

                                $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;
                                // dd($progressPercentagePart1, $completedTablesPart1, $totalTablesPart1);

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

                                $tahap = '';
                                $countRevisiSidang = \DB::table('berita_acara_skripsi')
                                    ->whereNotNull('acc_dospem')
                                    ->whereNotNull('acc_penguji_1')
                                    ->whereNotNull('acc_penguji_2')
                                    ->whereNotNull('acc_penguji_3')
                                    ->where('users_id', $data->id)
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

        // dd($progressRevisiSidang, $tahap);

                                $totalpart2 = count($tablesPart2);
                                $totalcompleted2 = $totalpart2 + 1;

                                $totaltabelhasil = $completedTablesPart2 + $progressRevisiSidang;
                                // dd($totaltabelhasil, $completedTablesPart2, $progressRevisiSidang);
                                $progressPercentagePart2 = ($totaltabelhasil / $totalcompleted2) * 50;
                                // $progressPercentagePart2 = ($completedTablesPart2 / ($tablesPart2)) * 50;
                                // dd($progressPercentagePart2, $totaltabelhasil, $totalcompleted2);

                                $proses1 = ($completedTablesPart1 / $totalTablesPart1) * 50;
                                // dd($proses1, $completedTablesPart1, $totalTablesPart1);

                                $proses2 = ($totaltabelhasil / $totalcompleted2) * 50;
                                // dd($proses2, $totaltabelhasil, $totalcompleted2);

                                $hasilprogress = $proses1 + $proses2;
                                // dd($hasilprogress, $proses1, $proses2);
                                $progressMahasiswa = number_format($hasilprogress, 2);

                            @endphp

                            {{-- {{ number_format($progressMahasiswa, 2) }}% --}}
                            @if($progressMahasiswa == 0)
                            <span class="mt-2">Belum memulai tahap skripsi</span>
                        @elseif($progressMahasiswa > 0 && $progressMahasiswa <= 10)
                            {{-- <span class="mt-2"><strong> Pengajuan Judul , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong> Pengajuan Judul</strong></span>
                        @elseif($progressMahasiswa > 10 && $progressMahasiswa <= 20)
                            {{-- <span class="mt-2"><strong> Bimbingan Proposal , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong> Bimbingan Proposal</strong></span>
                        @elseif($progressMahasiswa > 20 && $progressMahasiswa <= 30)
                            {{-- <span class="mt-2"><strong>Sidang Proposal , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong>Sidang Proposal</strong></span>
                        @elseif($progressMahasiswa > 30 && $progressMahasiswa <= 40)
                            {{-- <span class="mt-2"><strong>Revisi Sidang Proposal , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong>Revisi Sidang Proposal</strong></span>
                        @elseif($progressMahasiswa > 40 && $progressMahasiswa <= 50)
                            {{-- <span class="mt-2"><strong>Surat Tugas , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong>Surat Tugas</strong></span>
                        @elseif($progressMahasiswa > 50 && $progressMahasiswa <= 62.50)
                            <span class="mt-2"><strong>Bimbingan Skripsi</strong></span>
                            {{-- <span class="mt-2"><strong>Bimbingan Skripsi , {{$progressMahasiswa}}</strong></span> --}}
                        @elseif($progressMahasiswa > 62.50 && $progressMahasiswa <= 75)
                            <span class="mt-2"><strong>Sidang Skripsi</strong></span>
                            {{-- <span class="mt-2"><strong>Sidang Skripsi , {{$progressMahasiswa}}</strong></span> --}}
                        @elseif($progressMahasiswa > 75.00 && $progressMahasiswa <= 87.50)
                            {{-- <span class="mt-2"><strong>Revisi Sidang Skripsi , {{$progressMahasiswa}}</strong></span> --}}
                            <span class="mt-2"><strong>Revisi Sidang Skripsi</strong></span>
                        @elseif($progressMahasiswa > 87.50 && $progressMahasiswa <= 100)
                            <span class="mt-2"><strong> Skripsi Telah Selesai</strong></span>
                            {{-- <span class="mt-2"><strong> Skripsi Telah Selesai , {{$progressMahasiswa}}</strong></span> --}}
                        @else
                            <span class="mt-2">Skripsi Telah Selesai</span>
                        @endif
                        </td>
                          {{-- <td>
                              <a href="{{ url('/ketua_jurusan/data_mahasiswa/detail/' . $data->id) }}" class="btn btn-primary">Detail</a>
                          </td> --}}
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal{{ $data->id }}">Detail</button>
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
    </div>
</div>
@foreach($datamhs as $data)
<!-- Modal -->
<div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">Detail Mahasiswa - {{ $data->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">NPM </label>
                                        <p><span>{{ $data->kode_unik }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Nama </label>
                                        <p><span>{{ $data->name }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Judul </label>
                                        <p><span>{{ $data->judul ?? 'Belum Mengajukan'}}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Bidang Ilmu</label>
                                        <p><span>{{ $data->topik_bidang_ilmu ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing Utama </label>
                                        <p><span>{{ $data->dosen_pembimbing_utama ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing Pendamping </label>
                                        <p><span>{{$data->dosen_pembimbing_ii ?? 'Belum Mengajukan'}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Alamat </label>
                                        <p><span>{{ $data->alamat_orang_tua ?? 'Tidak Ada' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Nomor Telepon Orang Tua </label>
                                        <p><span>{{$data->no_telp_orang_tua ?? 'Tidak Ada'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Bootstrap CSS -->
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi modal secara manual untuk setiap ID modal
            @foreach($datamhs as $data)
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
