@extends('layout.master')

@section('title')
    Daftar Sidang Proposal
@endsection

@push('plugin-styles')
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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sidang Proposal Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            @if ($datas->status == 'pending')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3" style="font-weight: bold;">Pendaftaran Sidang Proposal Skripsi telah
                            disubmit.</h4>
                        <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu
                            akan dibuatkan jadwal.</h4>
                            <h6 class="mb-3">Status Pendaftaran :
                                <div class="alert alert-secondary mt-3" role="alert">
                                    Tunggu diperiksa koordinator.
                                </div>
                                </h4>
                    </div>
                </div>
            @elseif ($datas->status == 'terima')
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title mb-3" style="font-weight: bold;">Pendaftaran Sidang Proposal Skripsi telah
                            disubmit.</h4>
                        <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu
                            akan dibuatkan jadwal.</h4>
                            <h6 class="mb-3">Status Pendaftaran :
                                <div class="alert alert-success mt-3" role="alert">
                                    Selamat, Pendaftaran anda telah dibuatkan jadwal!
                                </div>
                                </h4>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title mb-0" style="font-weight: bold">Jadwal Sidang Proposal Skripsi.</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold;">NPM</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->kode_unik }}</span></p>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold;">Tanggal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @php
                                            $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal);
                                            $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                        @endphp
                                        <p><span>{{ $formatTanggal }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->name }}</span></p>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Waktu</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->jam }}</span></p>
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
                                        <p><span>{{ $datas->judul }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Ruang</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->nama_ruangan }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->dosen_pembimbing_utama }}</span></p>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span
                                                style="text-transform: capitalize;">{{ $datas->dosen_pembimbing_ii }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Penguji</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $datas->nama_penguji_1 }} (Dosen Penguji 1)<br />
                                                {{ $datas->nama_penguji_2 }} (Dosen Penguji 2)<br />
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Persiapan Sidang Proposal.</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <div>
                            <p style="color: #FF1600; font-weight: bold">Penting :</p>
                            <ul>
                                <li style="font-weight: bold">Menggandakan laporan skripsi sebanyak 3x.</li>
                                <li style="font-weight: bold">Membuat PowerPoint (PPT) untuk presentasi.</li>
                                <li style="font-weight: bold">Menggunakan pakaian Almamater dengan dalaman baju putih,
                                    dasi,
                                    serta celana hitam.</li>
                            </ul>
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
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
@endpush
