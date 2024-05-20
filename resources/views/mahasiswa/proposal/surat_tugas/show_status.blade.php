@extends('layout.master')

@section('title','Daftar Surat Tugas')

@push('plugin-styles')
    <!-- Menghubungkan stylesheet untuk flatpickr dan jquery-steps -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <style>
        .wizard>.content {
            min-height: 50em;
            /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
        }
    </style>
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Breadcrumb untuk navigasi halaman -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <!-- Menampilkan status pendaftaran berdasarkan kondisi -->
            @if ($datas->status == 'pending')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Pendaftaran Surat Tugas telah disubmit.</h4>
                        <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu
                            akan dicetak.</h6>
                        <h6 class="mb-3">Status Pendaftaran :
                            <div class="alert alert-secondary mt-3" role="alert">
                                Tunggu diperiksa koordinator.
                            </div>
                        </h6>
                    </div>
                </div>
            @elseif ($datas->status == 'terima')
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title mb-3" style="font-weight: bold">Pendaftaran Surat Tugas telah disubmit.</h4>
                        <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu
                            akan dicetak.</h6>
                        <h6 class="mb-3">Status Pendaftaran :
                            <div class="alert alert-success mt-3" role="alert">
                                Selamat, Pengajuan surat tugas anda sudah di acc. Surat tugas dapat diambil di CSR
                                Jurusan.
                            </div>
                        </h6>
                    </div>
                </div>
                <!-- Menampilkan detail surat tugas jika diterima -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title mb-0" style="font-weight: bold">Detail Surat Tugas.</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">NPM</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->kode_unik }}</span></p>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $datas->name }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Judul</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $datas->judul }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Nomor Surat Tugas</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->nomor_surat_tugas }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Tanggal Terbit</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @php
                                            $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_terbit);
                                            $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                        @endphp
                                        <p><span style="text-transform: capitalize;">{{ $formatTanggal }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Tanggal Kadaluwarsa</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @php
                                            $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_kadaluwarsa);
                                            $formatTanggal2 = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                        @endphp
                                        <p><span>{{ $formatTanggal2 }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{-- !-- row --> --}}
@endsection
@push('plugin-scripts')
    <!-- Menambahkan script untuk jquery-steps dan sweetalert2 -->
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
@endpush
