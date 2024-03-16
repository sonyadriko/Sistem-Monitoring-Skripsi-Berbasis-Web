@extends('layout.master')

@section('title')
    Detail Berita Acara Sidang Proposal
@endsection

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
            <li class="breadcrumb-item active" aria-current="page">BA Sidang Proposal</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Berita Acara Sidang Proposal</h5>
                <form action="{{ route('koor-berita-acara-cetak.detail', ['id' => $data->id_berita_acara_p]) }}"
                    method="POST" id="cetakForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">NPM </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $data->kode_unik }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">No Ujian </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span>{{ $data->id_berita_acara_p }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Nama </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $data->name }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Tanggal </label>
                                    </div>
                                    <div class="col-sm-9">
                                        @php
                                            $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
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
                                        <label class="form-label" style="font-weight: bold">Judul </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $data->judul }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Ruang, Waktu </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $data->nama_ruangan }},
                                                {{ $data->jam }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1 </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span
                                                style="text-transform: capitalize;">{{ $data->dosen_pembimbing_utama }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2 </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span
                                                style="text-transform: capitalize;">{{ $data->dosen_pembimbing_ii }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Penguji </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <p><span style="text-transform: capitalize;">{{ $data->nama_penguji_1 }} (Dosen
                                                Penguji
                                                1)<br />
                                                {{ $data->nama_penguji_2 }} (Dosen Penguji 2)</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="berita_acara_proposal_id" value="{{ $data->id_berita_acara_p }}" />
                        <div class="mb-3">
                            <span style="font-weight: bold">Cetak Revisi: </span>
                            @if (count($bad) >= 3)
                                @if (is_null($data) || is_null($data->cetak_revisi))
                                    <button type="button" class="btn btn-primary"
                                        onclick="showConfirmation()">Cetak</button>
                                @else
                                    <span>Sudah dicetak </span>
                                @endif
                            @else
                                <span style="color: #FF0000">Seluruh dosen belum mengisi berita acara</span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Review Dosen Pembimbing</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Revisi</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($bad as $bad)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $bad->name }}</td>
                                        <td>{{ $bad->revisi }}</td>
                                        <td>{{ $bad->nilai }}</td>
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
