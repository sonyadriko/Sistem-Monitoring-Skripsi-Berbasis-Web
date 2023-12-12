@extends('layout.master')

@section('title')
Daftar Surat Tugas
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
        <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
            @if ($datas->status == 'pending')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Surat Tugas  </h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-0">Pendaftaran Surat Tugas telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dicetak.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-secondary" role="alert">
                            Tunggu diperiksa koordinator.
                        </div>
                    </h4>
                </div>
            </div>
            @elseif ($datas->status == 'terima')
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Surat Tugas </h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-0">Pendaftaran Surat Tugas telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dicetak.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-success" role="alert">
                            Selamat.
                        </div>
                    </h4>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Jadwal Seminar Proposal Skripsi.</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless datatables-basic"/>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>NPM</td>
                                    <td>{{$datas->kode_unik}}</td>
                                    <td>Nama</td>
                                    <td>{{$datas->name}}</td>
                                </tr>
                                <tr>
                                    <td>Tema / Judul</td>
                                    <td>{{$datas->judul}}</td>
                                    <td>Nomor Surat Tugas</td>
                                    <td>{{$datas->nomor_surat_tugas}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terbit</td>
                                    @php
                                        $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_terbit);
                                        $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                    @endphp
                                    <td>{{$formatTanggal}}</td>
                                    <td>Tanggal Kadaluwarsa</td>
                                    @php
                                        $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_kadaluwarsa);
                                        $formatTanggal2 = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                    @endphp
                                    <td>{{$formatTanggal2}}</td>
                                </tr>
                            </tbody>
                        </table>
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
