@extends('layout.master')

@section('title', 'Detail Berita Acara Proposal')

@section('css')
    <!-- Menghubungkan stylesheet untuk DataTables dan komponen-komponen terkait -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/css/datatables.net-bs4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/css/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/css/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Breadcrumb untuk navigasi -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sidang Proposal</li>
        </ol>
    </nav>

    <!-- Kontainer utama untuk detail berita acara -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Sidang Proposal</h5>
            <div class="card-body table-responsive">
                @php
                    // Mendefinisikan field informasi yang akan ditampilkan
                    $infoFields = [
                        ['label' => 'NPM', 'value' => $data->kode_unik],
                        ['label' => 'No. Ujian', 'value' => $data->id_berita_acara_p],
                        ['label' => 'Nama', 'value' => $data->name],
                        ['label' => 'Tanggal', 'value' => date('d F Y', strtotime($data->tanggal))],
                        ['label' => 'Judul', 'value' => $data->judul],
                        ['label' => 'Ruang, Waktu', 'value' => $data->nama_ruangan . ', ' . $data->jam],
                        ['label' => 'Dosen Pembimbing 1', 'value' => $data->dosen_pembimbing_utama],
                        ['label' => 'Dosen Pembimbing 2', 'value' => $data->dosen_pembimbing_ii],
                        ['label' => 'Dosen Penguji 1', 'value' => $data->nama_penguji_1],
                        ['label' => 'Dosen Penguji 2', 'value' => $data->nama_penguji_2]
                    ];
                @endphp
                <!-- Menampilkan informasi dalam dua kolom -->
                <div class="row">
                    <div class="col-md-6">
                        @foreach ($infoFields as $index => $field)
                            @if ($index % 2 == 0)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label" style="font-weight: bold">{{ $field['label'] }}</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><span>{!! $field['value'] !!}</span></p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach ($infoFields as $index => $field)
                            @if ($index % 2 != 0)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="form-label" style="font-weight: bold">{{ $field['label'] }}</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><span>{!! $field['value'] !!}</span></p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menghubungkan form review -->
    @include('dosen.berita_acara.seminar.review_form')

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Fungsi untuk mengirim form setelah validasi
    function submitForm() {
        var revisi = document.getElementById('revisi').value;
        var nilai = document.getElementById('nilai').value;

        // Validasi input form
        if (!revisi.trim() || !nilai.trim()) {
            Swal.fire({
                title: 'Error',
                text: 'Revisi dan nilai harus diisi.',
                icon: 'error',
            });
        } else if (parseInt(nilai) > 100) {
            Swal.fire({
                title: 'Error',
                text: 'Nilai tidak boleh lebih dari 100.',
                icon: 'error',
            });
        } else {
            document.getElementById('reviewForm').submit();
        }
    }
</script>

