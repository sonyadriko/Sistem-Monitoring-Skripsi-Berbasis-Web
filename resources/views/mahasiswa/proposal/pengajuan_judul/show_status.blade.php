@extends('layout.master')

@section('title')
Daftar Seminar Proposal
@endsection

@push('plugin-styles')
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
<style>
    .wizard > .content {
        min-height: 50em; /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
    }
</style>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengajuan Judul</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
            @if ($datas->status == 'pending')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="font-weight: bold;">Pengajuan Judul Proposal Skripsimu Sudah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator.</h4>
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
                    <h4 class="card-title mb-3" style="font-weight: bold;">Pengajuan Judul Proposal Skripsimu Sudah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-success mt-3" role="alert">
                            Selamat, Pendaftaran anda telah diacc koordinator!
                        </div>
                    </h4>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Pengajuan Judul.</h4>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">NPM</label>
                                <p><span>{{ $datas->kode_unik }}</span></p>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Nama</label>
                                <p><span>{{ $datas->name }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Judul</label>
                                <p><span>{{ $datas->judul }}</span></p>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Bidang Ilmu</label>
                                <p><span>{{ $datas->topik_bidang_ilmu }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1</label>
                                <p><span>{{ $datas->dosen_pembimbing_utama }}</span></p>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2</label>
                                <p><span>{{ $datas->dosen_pembimbing_ii }}</span></p>
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
<script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')

@endpush
