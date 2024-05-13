@extends('layout.master')

@section('title', 'Detail Surat Tugas')

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
            <li class="breadcrumb-item"><a href="#">Proposal & Skripsi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Tugas</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Detail Pengajuan Surat Tugas</h5>
                <div class="card-body">
                    <form action="{{ route('koor-surat-tugas.update', $data->id_surat_tugas) }}" method="POST"
                        id="cetakForm">
                        @csrf
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm"
                                value="{{ $data->kode_unik }}" readonly disabled />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $data->name }}" readonly disabled />
                        </div>
                        <div class="mb-3">
                            <label for="bidang_ilmu" class="form-label">Alamat Mahasiswa</label>
                            <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu"
                                value="{{ $data->alamat_mhs }}" readonly disabled />
                        </div>
                        <div class="mb-3">
                            <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                            <input type="text" class="form-control" id="dospem_utama" name="dospem_utama"
                                value="{{ $data->dosen_pembimbing_utama }}" readonly disabled />
                        </div>
                        <div class="mb-3">
                            <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                            <input type="text" class="form-control" name="dospem_2" id="dospem_2"
                                value="{{ $data->dosen_pembimbing_ii }}" readonly disabled />
                        </div>
                        <div class="mb-3">
                            <label for="tgl_seminar" class="form-label">Tanggal Sidang Proposal</label>
                            <input type="text" class="form-control" name="tgl_seminar" id="tgl_seminar"
                                value="{{ \Carbon\Carbon::parse($data->tanggal_sidang_proposal)->formatLocalized('%d %B %Y') }}"
                                readonly disabled />
                        </div>
                        <input type="hidden" value="{{ $data->bimbingan_proposal_id }}" id="bimproid" name="bimproid" />
                        <input type="hidden" value="{{ $data->users_id }}" id="users_id" name="users_id" />
                        <div class="mb-3">
                            <label class="form-label">File Proposal</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ basename($data->file_proposal) }}"
                                    readonly>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="window.open('{{ asset($data->file_proposal) }}', '_blank')">Lihat</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slip Pembayaran Bimbingan</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    value="{{ basename($data->file_slip_pembayaran) }}" readonly>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="window.open('{{ asset($data->file_slip_pembayaran) }}', '_blank')">Lihat</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary"
                                onclick="window.history.back();">Kembali</button>
                            @if ($data->status == 'pending')
                                <button type="button" class="btn btn-primary"
                                    onclick="showConfirmation()">Cetak</button>
                            @elseif($data->status == 'terima')
                                <a href="{{ url('/koordinator/surat_tugas/lihat_file/' . $data->id_surat_tugas) }}"
                                    target="_blank" class="btn btn-primary">Lihat File</a>
                            @elseif($data->status == 'tolak')
                                <p>Data ini telah ditolak.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                        Swal.fire({
                            title: 'Surat Tugas Dicetak',
                            text: 'Surat Tugas berhasil dicetak.',
                            icon: 'success',
                        }).then(() => {
                            document.getElementById('cetakForm').submit();
                        });
                    }
                });
            }
        </script>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
