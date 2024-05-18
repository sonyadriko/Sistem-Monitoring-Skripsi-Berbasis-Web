@extends('layout.master')

{{-- Judul Halaman --}}
@section('title', 'Detail Berita Acara Sidang Skripsi')

{{-- CSS Khusus Halaman --}}
@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Konten Halaman --}}
@section('content')
    {{-- Breadcrumb Navigasi --}}
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
            <li class="breadcrumb-item active" aria-current="page">BA Sidang Skripsi</li>
        </ol>
    </nav>

    {{-- Konten Utama --}}
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Berita Acara Sidang Skripsi</h5>
                <div class="card-body table-responsive">
                    @php
                        $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'No. Ujian', 'value' => $data->id_berita_acara_s],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Tanggal', 'value' => date('d F Y', strtotime($data->tanggal))],
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
    </div>

    {{-- Form Review Dosen Pembimbing --}}
    @include('dosen.berita_acara.sidang.review_form')

@endsection

{{-- Scripts Khusus Halaman --}}
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

{{-- Fungsi JavaScript untuk Submit Form --}}
@include('dosen.berita_acara.sidang.submit_form_script')

