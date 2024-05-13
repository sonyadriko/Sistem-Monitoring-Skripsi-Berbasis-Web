@extends('layout.master')

@section('title', 'Detail Berita Acara Sidang Skripsi')

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
            <li class="breadcrumb-item active" aria-current="page">BA Sidang Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Berita Acara Sidang Skripsi</h5>
                <form action="{{ route('koor-berita-acara-s-cetak.detail', ['id' => $data->id_berita_acara_s]) }}"
                    method="POST" id="cetakForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">NPM</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p>{{ $data->kode_unik }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">No Ujian</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p>{{ $data->id_berita_acara_s }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Nama</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Tanggal</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @php
                                            $formattedDate = \Carbon\Carbon::parse($data->tanggal)->isoFormat(
                                                'dddd, D MMMM Y',
                                                'id',
                                            );
                                        @endphp
                                        <p>{{ $formattedDate }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Judul</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->judul }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Ruang, Waktu</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->nama_ruangan }}, {{ $data->jam }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Dosen Pembimbing 1</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->dosen_pembimbing_utama }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Dosen Pembimbing 2</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->dosen_pembimbing_ii }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight:bold">Dosen Penguji</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-capitalize">{{ $data->nama_penguji_1 }} (Dosen Penguji 1)<br />
                                            {{ $data->nama_penguji_2 }} (Dosen Penguji 2)<br />
                                            {{ $data->nama_penguji_3 }} (Dosen Penguji 3)<br />
                                            {{ $data->nama_sekretaris }} (Sekretaris)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="berita_acara_skripsi_id" value="{{ $data->id_berita_acara_s }}" />
                        <div class="mb-3">
                            <span style="font-weight:bold">Cetak Revisi: </span>
                            @if (count($bad) >= 4)
                                @if (is_null($data) || is_null($data->cetak_revisi))
                                    <button type="button" class="btn btn-primary"
                                        onclick="showConfirmation()">Cetak</button>
                                @else
                                    <span>Sudah dicetak</span>
                                @endif
                            @else
                                <span class="text-danger">Seluruh dosen belum mengisi berita acara</span>
                            @endif
                        </div>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Revisi</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bad as $index => $bad)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bad->name }}</td>
                                    <td>{{ $bad->revisi }}</td>
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
