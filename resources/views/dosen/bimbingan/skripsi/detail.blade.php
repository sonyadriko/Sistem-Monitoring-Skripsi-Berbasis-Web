@extends('layout.master')

@section('title', 'Detail Bimbingan Skripsi')

{{-- Menghubungkan file CSS yang diperlukan untuk DataTables --}}
@section('css')
    @foreach (['datatables.net-bs4', 'datatables.net-buttons-bs4', 'datatables.net-responsive-bs4'] as $lib)
        <link href="{{ asset("assets2/libs/$lib/$lib.min.css") }}" rel="stylesheet" type="text/css" />
    @endforeach
@endsection

{{-- Konten utama halaman detail bimbingan skripsi --}}
@section('content')
    {{-- Breadcrumb untuk navigasi halaman --}}
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Skripsi</li>
        </ol>
    </nav>
    {{-- Menampilkan data mahasiswa dan dosen pembimbing --}}
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card mb-4">
                <h5 class="card-header" style="color: #171717">Data Mahasiswa dan Dosen Pembimbing</h5>
                <div class="card-body">
                    @php
                        $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Judul', 'value' => $data->judul],
                            ['label' => 'Bidang Ilmu', 'value' => $data->topik_bidang_ilmu],
                            ['label' => 'Dosen Pembimbing Utama', 'value' => $data->dosen_pembimbing_utama],
                            ['label' => 'Dosen Pembimbing II', 'value' => $data->dosen_pembimbing_ii],
                        ];
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($infoFields as $index => $field)
                                @if ($index % 2 == 0)
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label class="form-label" style="font-weight:bold">{{ $field['label'] }}</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><span>{{ $field['value'] }}</span></p>
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
                                            <label class="form-label" style="font-weight:bold">{{ $field['label'] }}</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><span>{{ $field['value'] }}</span></p>
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
    {{-- Menampilkan tombol tambah revisi jika diperlukan --}}
    <div class="row">
        <div class="mb-3">
            @if (Auth::user()->name == $data->dosen_pembimbing_utama)
                @if ($data->acc_dosen_utama == null)
                    <button type="button" class="btn btn-primary mb-4" onclick="openRevisiModal()">
                        Tambahkan Revisi
                    </button>
                @endif
            @elseif (Auth::user()->name == $data->dosen_pembimbing_ii)
                @if ($data->acc_dosen_ii == null)
                    <button type="button" class="btn btn-primary mb-4" onclick="openRevisiModal()">
                        Tambahkan Revisi
                    </button>
                @endif
            @endif
            <input type="hidden" id="idBimbinganSkripsi" name="idBimbinganSkripsi"
                value="{{ $data->id_bimbingan_skripsi }}">
            {{-- Menampilkan history bimbingan jika ada --}}
            @if ($detail->isEmpty())
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="font-weight: bold">History Bimbingan</h4>
                        </div>
                        <div class="card-body mb-4 mb-xl-0">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bimbingan</th>
                                            <th>Tanggal</th>
                                            <th>Revisi Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}
                                                </td>
                                                <td>{{ $item->revisi }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- Memasukkan modal revisi dan alert sukses --}}
    @include('dosen.bimbingan.skripsi.revisi-modal')
    @include('dosen.bimbingan.skripsi.success-alert', ['buttonId' => 'okButton'])
    @include('dosen.bimbingan.skripsi.skripsi-approval', ['minBimbingan' => 12])
@endsection


@foreach (['datatables.net', 'datatables.net-bs4', 'datatables.net-buttons', 'datatables.net-buttons-bs4', 'jszip', 'pdfmake', 'datatables.net-responsive', 'datatables.net-responsive-bs4'] as $lib)
    <script src="{{ asset("assets2/libs/$lib/$lib.min.js") }}"></script>
@endforeach
<script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets2/js/app.min.js') }}"></script>

{{-- Script untuk fungsi modal revisi, acc revisi, dan acc proposal --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function openRevisiModal() {
        // Membuka modal revisi
        $('#revisiModal').modal('show');
    }
    // Pastikan dokumen telah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen 'revisiForm' jika ada
        var revisiForm = document.getElementById('revisiForm');
        // Periksa apakah elemen 'revisiForm' ditemukan
        if (revisiForm) {
            // Tambahkan event listener untuk saat form di-submit
            revisiForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var revisiInput = document.getElementById("revisiInput").value;
                var idBimbinganSkripsi = document.getElementById('idBimbinganSkripsi').value;
                axios.post(`/dosen/bimbingan_skripsi/tambahrevisi`, {
                        revisi: revisiInput,
                        idBimbinganSkripsi: idBimbinganSkripsi
                    })
                    .then(function(response) {
                        $('#revisiModal').modal('hide'); // Tutup modal setelah berhasil submit
                        Swal.fire({
                            title: 'Revisi berhasil dikirim!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Lakukan refresh halaman
                                location.reload();
                            }
                        });
                    })
                    .catch(function(error) {
                        console.error("Terjadi kesalahan: " + error);
                    });
            });
        } else {
            console.error("Elemen 'revisiForm' tidak ditemukan.");
        }
    });

    function confirmAccRevisi(idDetailBimbinganProposal) {
        Swal.fire({
            title: 'Apakah anda yakin acc revisi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                accRevisi(idDetailBimbinganProposal);
            }
        });
    }

    function accRevisi(idDetailBimbinganProposal) {
        // Lakukan update data ke server menggunakan AJAX
        axios.post(`/dosen/bimbingan_skripsi/accrevisi/${idDetailBimbinganProposal}`)
            .then(function(response) {
                // Tampilkan pesan sukses menggunakan SweetAlert
                Swal.fire({
                    title: 'Revisi berhasil diacc!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan refresh halaman
                        location.reload();
                    }
                });
            })
            .catch(function(error) {
                console.error("Terjadi kesalahan: " + error);
            });
    }

    function confirmAccProposal(idBimbinganSkripsi) {
        const dospem1 = document.getElementById('dospem1').value;
        const dospem2 = document.getElementById('dospem2').value;

        Swal.fire({
            title: 'Apakah anda yakin acc skripsi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                accProposal(idBimbinganSkripsi, dospem1, dospem2);
            }
        });
    }

    function accProposal(idBimbinganSkripsi, dospem1, dospem2) {
        const data = {
            dospem1: dospem1,
            dospem2: dospem2
        };

        axios.post(`/dosen/bimbingan_skripsi/accproposal/${idBimbinganSkripsi}`, data)
            .then(function(response) {
                Swal.fire({
                    title: 'Skripsi berhasil diacc!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            })
            .catch(function(error) {
                // Handle JSON response failure
                console.error('Terjadi kesalahan:', error);
                if (error.response && error.response.data) {
                    // If the response contains error message
                    Swal.fire({
                        title: 'Terjadi kesalahan',
                        text: error.response.data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // If the response does not contain error message
                    Swal.fire({
                        title: 'Terjadi kesalahan',
                        text: 'Gagal memproses permintaan.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
    }
</script>

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
