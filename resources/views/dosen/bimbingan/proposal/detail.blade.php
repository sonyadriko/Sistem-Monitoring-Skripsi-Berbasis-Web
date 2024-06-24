@extends('layout.master')

@section('title')
    Detail Bimbingan Proposal
@endsection

@section('css')
    @foreach (['datatables.net-bs4', 'datatables.net-buttons-bs4', 'datatables.net-responsive-bs4'] as $lib)
        <link href="{{ asset("assets2/libs/$lib/$lib.min.css") }}" rel="stylesheet" type="text/css" />
    @endforeach
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proposal Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card mb-4">
                <h5 class="card-header">Data Mahasiswa dan Dosen Pembimbing</h5>
                <div class="card-body">
                    @php
                        // Mendefinisikan field informasi yang akan ditampilkan
                        $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Judul', 'value' => $data->judul],
                            ['label' => 'Bidang Ilmu', 'value' => $data->topik_bidang_ilmu],
                            ['label' => 'Dosen Pembimbing Utama', 'value' => $data->dosen_pembimbing_utama],
                            ['label' => 'Dosen Pembimbing II', 'value' => $data->dosen_pembimbing_ii],
                        ];
                    @endphp
                    <!-- Menampilkan informasi dalam dua kolom -->
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
    <div class="row">
        <div class="mb-3">
            {{-- Kondisi untuk menampilkan tombol tambah revisi berdasarkan user yang login dan status acc dosen --}}
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
            <input type="hidden" id="idBimbinganProposal" name="idBimbinganProposal"
                value="{{ $data->id_bimbingan_proposal }}">
            {{-- Tabel untuk menampilkan detail bimbingan jika ada --}}
            @if ($detail->isNotEmpty())
                <div class="card mb-4 mb-xl-0">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bimbingan</th>
                                    <th>Tanggal</th>
                                    <th>Revisi Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop untuk menampilkan setiap item bimbingan --}}
                                @foreach ($detail as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $item->revisi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('dosen.bimbingan.proposal.revisi-modal', [
        'id' => 'revisiModal',
        'title' => 'Revisi Proposal',
        'formId' => 'revisiForm',
        'inputId' => 'revisiInput',
    ])
    @include('dosen.bimbingan.proposal.success-alert', [
        'id' => 'successAlert',
        'message' => 'Revisi berhasil dikirim!',
        'buttonId' => 'okButton',
    ])
    @include('dosen.bimbingan.proposal.proposal-approval', ['data' => $data])


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function openRevisiModal() {
        // Open the modal
        $('#revisiModal').modal('show');

        // Optionally, you can set other values or perform other actions here

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
                var idBimbinganProposal = document.getElementById('idBimbinganProposal').value;
                console.log('Revisi yang dikirim:', revisiInput);
                console.log('ID Bimbingan Proposal:', idBimbinganProposal);

                axios.post(`/dosen/bimbingan_proposal/tambahrevisi`, {
                        revisi: revisiInput,
                        idBimbinganProposal: idBimbinganProposal
                    })
                    .then(function(response) {
                        console.log('Respon dari server:', response.data);
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


    function confirmAccProposal(idBimbinganProposal) {
        var dospem1Element = document.getElementById('dospem1');
        var dospem2Element = document.getElementById('dospem2');

        // Check if the elements exist before accessing their values
        if (dospem1Element && dospem2Element) {
            const dospem1 = dospem1Element.value;
            const dospem2 = dospem2Element.value;

            Swal.fire({
                title: 'Apakah anda yakin acc proposal ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    accProposal(idBimbinganProposal, dospem1, dospem2);
                }
            });
        } else {
            console.error("Elemen 'dospem1' or 'dospem2' not found.");
        }
    }


    function accProposal(idBimbinganProposal, dospem1, dospem2) {
        const data = {
            dospem1: dospem1,
            dospem2: dospem2
        };

        axios.post(`/dosen/bimbingan_proposal/accproposal/${idBimbinganProposal}`, data)
            .then(function(response) {
                console.log('Response from the server:', response.data);

                // Show success message using SweetAlert
                Swal.fire({
                    title: 'Proposal berhasil diacc!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(); // Reload the page
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
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
