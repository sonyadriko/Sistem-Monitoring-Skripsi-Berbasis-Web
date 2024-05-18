@extends('layout.master')

@section('title', 'Detail Berita Acara Sidang Skripsi')

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<!-- Breadcrumb untuk navigasi halaman -->
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Lain-lain</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sekretaris</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Sidang Skripsi</h5>
            <!-- Form untuk mencetak berita acara -->
            <form action="{{ route('koor-berita-acara-s-cetak.detail', ['id' => $data->id_berita_acara_s]) }}" method="POST" id="cetakForm">
                @csrf
                <div class="card-body">
                    @php
                        // Mendefinisikan array dengan informasi yang akan ditampilkan di halaman detail
                        $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'No. Ujian', 'value' => $data->id_berita_acara_s],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Tanggal', 'value' => \Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y', 'id')],
                            ['label' => 'Judul', 'value' => $data->judul],
                            ['label' => 'Ruang, Waktu', 'value' => $data->nama_ruangan . ', ' . $data->jam],
                            ['label' => 'Dosen Pembimbing 1', 'value' => $data->dosen_pembimbing_utama],
                            ['label' => 'Dosen Pembimbing 2', 'value' => $data->dosen_pembimbing_ii],
                            ['label' => 'Dosen Penguji', 'value' => implode('<br />', [
                                $data->nama_penguji_1 . ' (Dosen Penguji 1)',
                                $data->nama_penguji_2 . ' (Dosen Penguji 2)',
                                $data->nama_penguji_3 . ' (Dosen Penguji 3)',
                                $data->nama_sekretaris . ' (Sekretaris)'
                            ])]
                        ];
                    @endphp
                    <div class="row">
                        {{-- // Loop melalui setiap field informasi untuk menampilkan label dan nilai --}}
                        @foreach ($infoFields as $index => $field)
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        {{-- // Menampilkan label dengan gaya tebal --}}
                                        <label class="form-label" style="font-weight: bold">{{ $field['label'] }}</label>
                                    </div>
                                    <div class="col-sm-8">
                                        {{-- // Menampilkan nilai dari field informasi --}}
                                        <p>{!! $field['value'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- // Menyimpan ID berita acara skripsi sebagai input tersembunyi --}}
                    <input type="hidden" name="berita_acara_skripsi_id" value="{{ $data->id_berita_acara_s }}" />
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <h5 class="card-header">Review Dosen Pembimbing</h5>
        <div class="card-body">
            <div class="table-responsive">
                <!-- Tabel untuk menampilkan review dari dosen pembimbing -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Revisi</th>
                          <th>Nilai Penulisan</th>
                          <th>Nilai Penyajian</th>
                          <th>Nilai Penguasaan Program</th>
                          <th>Nilai Penguasaan Materi</th>
                          <th>Nilai Penampilan</th>
                          <th>Nilai Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bad as $index => $bad)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bad->name }}</td>
                            <td>{{ $bad->revisi }}</td>
                            <td>{{ $bad->nilai_penulisan }}</td>
                            <td>{{ $bad->nilai_penyajian }}</td>
                            <td>{{ $bad->nilai_penguasaan_program }}</td>
                            <td>{{ $bad->nilai_penguasaan_materi }}</td>
                            <td>{{ $bad->nilai_penampilan }}</td>
                            <td>{{ $bad->nilai_total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between mt-4">
    <!-- Tombol untuk kembali ke halaman sebelumnya -->
    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
</div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Fungsi untuk menampilkan konfirmasi sebelum mencetak
    function showConfirmation() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin mencetak?',
            text: 'Pastikan data sudah benar sebelum mencetak.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cetak!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cetakForm').submit();
            }
        });
    }
</script>
