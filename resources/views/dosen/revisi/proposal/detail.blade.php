@extends('layout.master')

@section('title', 'Detail Revisi Sidang Proposal')

@section('css')
    <!-- Menghubungkan dengan CSS untuk DataTables -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Breadcrumb untuk navigasi halaman -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Revisi Sidang Proposal</li>
        </ol>
    </nav>

    <!-- Bagian untuk menampilkan informasi mahasiswa dan dosen pembimbing -->
    <div class="card-body">
        @php
           $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Judul', 'value' => $data->judul],
                            ['label' => 'Bidang Ilmu', 'value' => $data->topik_bidang_ilmu],
                            ['label' => 'Dosen Pembimbing Utama', 'value' => $data->dosen_pembimbing_utama],
                            ['label' => 'Dosen Pembimbing II', 'value' => $data->dosen_pembimbing_ii]
                        ];
        @endphp
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card mb-4">
                    <h5 class="card-header" style="color: #171717">Data Mahasiswa dan Dosen Pembimbing</h5>
                    <div class="card-body">
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
    </div>
    @php
        $roles = [
            'nama_penguji_1' => 'tgl_acc_penguji_1',
            'nama_penguji_2' => 'tgl_acc_penguji_2',
            'dosen_pembimbing_utama' => 'tgl_acc_dospem'
        ];
    @endphp

    <!-- Tombol untuk menambahkan revisi jika pengguna adalah penguji atau pembimbing yang belum menyetujui -->
    @foreach ($roles as $role => $date)
        @if (Auth::user()->name == $data->$role && is_null($data->$date))
            <button type="button" class="btn btn-primary justify-content-end mb-4" id="tambahkanRevisiButton" onclick="openRevisiModal()">
                Tambahkan Revisi
            </button>
            @break
        @endif
    @endforeach

    <!-- Input tersembunyi untuk menyimpan ID revisi -->
    <input type="hidden" id="idRevisiBimbinganProposal" name="idRevisiBimbinganProposal" value="{{ $data->id_revisi_seminar_proposal }}">

    <!-- Tabel untuk menampilkan detail revisi jika ada -->
    @unless ($detail->isEmpty())
        <div class="row">
            <div class="mb-3">
                <div class="card mb-4 mb-xl-0">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Revisi</th>
                                </tr>
                            </thead>
                            <tbody>
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
            </div>
        </div>
    @endunless

    @include('dosen.revisi.proposal.revisi-modal')
    @include('dosen.revisi.proposal.success-alert')

    @include('dosen.revisi.proposal.persetujuan-revisi', ['data' => $data])
@endsection
    @push('scripts')
    <!-- Menghubungkan dengan library jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Menghubungkan dengan library Axios untuk permintaan HTTP -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Menghubungkan dengan library SweetAlert2 untuk tampilan alert yang lebih baik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Menghubungkan dengan library Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk membuka modal revisi
        function openRevisiModal() {
            // Mendapatkan tombol tambah revisi
            const addButton = document.getElementById('tambahkanRevisiButton');
            // Memeriksa apakah tombol ada dan ditampilkan
            if (addButton && addButton.style.display !== 'none') {
                // Menampilkan modal revisi
                $('#revisiModal').modal('show');
            }
        }
    </script>

    <script>
        // Menunggu dokumen untuk dimuat sepenuhnya
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan form revisi
            var revisiForm = document.getElementById('revisiForm');

            // Memeriksa apakah form revisi ditemukan
            if (revisiForm) {
                // Menambahkan event listener untuk submit form
                revisiForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    // Mengambil nilai input revisi dan ID revisi
                    var revisiInput = document.getElementById("revisiInput").value;
                    var idRevisiBimbinganProposal = document.getElementById('idRevisiBimbinganProposal').value;

                    // Mengirim data revisi ke server menggunakan Axios
                    axios.post(`/dosen/revisi_seminar_proposal/tambahrevisi`, {
                            revisiInput: revisiInput,
                            idRevisiBimbinganProposal: idRevisiBimbinganProposal
                        })
                        .then(function(response) {
                            // Menutup modal dan menampilkan pesan sukses
                            $('#revisiModal').modal('hide');
                            Swal.fire({
                                title: 'Revisi berhasil dikirim!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
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

        // Fungsi untuk konfirmasi acc proposal
        function confirmAccProposal(idBeritaAcara) {
            // Mendapatkan elemen input untuk dospem dan penguji
            const dospemElement = document.getElementById('dospem');
            const penguji1Element = document.getElementById('penguji1');
            const penguji2Element = document.getElementById('penguji2');

            if (dospemElement && penguji1Element && penguji2Element) {
                dospem = dospemElement.value;
                penguji1 = penguji1Element.value;
                penguji2 = penguji2Element.value;

                // Menampilkan konfirmasi dengan SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin ingin acc revisi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        accProposal(idBeritaAcara, dospem, penguji1, penguji2);
                    }
                });
            } else {
                console.error('Error: One or more elements not found.');
            }
        }

        // Fungsi untuk acc proposal
        function accProposal(idBeritaAcara, dospem, penguji1, penguji2) {
            const data = {
                dospem: dospem,
                penguji1: penguji1,
                penguji2: penguji2
            };
            // Mengirim data acc proposal ke server
            axios.post(`/dosen/revisi_seminar_proposal/accrevisi/${idBeritaAcara}`, data)
                .then(function(response) {
                    // Menampilkan pesan sukses dan memuat ulang halaman
                    Swal.fire({
                        title: 'Revisi Proposal berhasil diacc!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Terjadi kesalahan:', error);
                    if (error.response && error.response.data) {
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            text: error.response.data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
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
    @endpush

    @push('plugin-scripts')
        <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    @endpush

