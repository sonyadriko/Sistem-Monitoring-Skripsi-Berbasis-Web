@extends('layout.master')

@section('title', 'Detail Revisi Sidang Skripsi')

@section('css')
    <!-- Menghubungkan stylesheet untuk DataTables -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/css/datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Breadcrumb untuk navigasi halaman -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Revisi Sidang Skripsi</li>
        </ol>
    </nav>

    <!-- Bagian utama konten halaman -->
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card mb-4">
                <h5 class="card-header">Revisi Sidang Skripsi</h5>
                <div class="card-body">
                    @php
                        // Mendefinisikan field informasi yang akan ditampilkan
                        $infoFields = [
                            ['label' => 'NPM', 'value' => $data->kode_unik],
                            ['label' => 'Nama', 'value' => $data->name],
                            ['label' => 'Judul', 'value' => $data->judul],
                            ['label' => 'Bidang Ilmu', 'value' => $data->topik_bidang_ilmu],
                            ['label' => 'Dosen Pembimbing Utama', 'value' => $data->dosen_pembimbing_utama],
                            ['label' => 'Dosen Pembimbing II', 'value' => $data->dosen_pembimbing_ii]
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

    @php
        $roles = [
            'nama_penguji_1' => 'tgl_acc_penguji_1',
            'nama_penguji_2' => 'tgl_acc_penguji_2',
            'nama_penguji_3' => 'tgl_acc_penguji_3',
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
    <input type="hidden" id="idRevisiBimbinganSkripsi" name="idRevisiBimbinganSkripsi"
    value="{{ $data->id_revisi_sidang_skripsi }}">

    <!-- Tabel untuk menampilkan detail revisi -->
    <div class="row">
        <div class="mb-3">
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
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

    <!-- Include modal revisi, alert sukses, dan persetujuan revisi -->
    @include('dosen.revisi.skripsi.modal-revisi')
    @include('dosen.revisi.skripsi.alert_success')
    @include('dosen.revisi.skripsi.persetujuan-revisi')

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Fungsi untuk membuka modal revisi
    function openRevisiModal() {
        // Menampilkan modal revisi
        $('#revisiModal').modal('show');
    }
</script>

<script>
    // Menangani ketika dokumen telah dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen form revisi
        var revisiForm = document.getElementById('revisiForm');

        // Menambahkan event listener untuk submit form
        if (revisiForm) {
            revisiForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah submit form default

                // Mengambil nilai input dari form
                var revisiInput = document.getElementById("revisiInput").value;
                var idRevisiBimbinganSkripsi = document.getElementById('idRevisiBimbinganSkripsi').value;

                // Mengirim data revisi ke server menggunakan axios
                axios.post(`/dosen/revisi_sidang_skripsi/tambahrevisi`, {
                        revisiInput: revisiInput,
                        idRevisiBimbinganSkripsi: idRevisiBimbinganSkripsi
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
                                location.reload(); // Memuat ulang halaman
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
</script>

<script>
    // Fungsi untuk konfirmasi acc skripsi
    function confirmAccSkripsi(idBeritaAcara) {
        // Mendapatkan elemen input dari form
        const dospemElement = document.getElementById('dospem');
        const penguji1Element = document.getElementById('penguji1');
        const penguji2Element = document.getElementById('penguji2');
        const penguji3Element = document.getElementById('penguji3');

        // Memeriksa dan mengambil nilai dari elemen input
        if (dospemElement && penguji1Element && penguji2Element && penguji3Element) {
            const dospem = dospemElement.value;
            const penguji1 = penguji1Element.value;
            const penguji2 = penguji2Element.value;
            const penguji3 = penguji3Element.value;

            // Menampilkan dialog konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin ingin acc revisi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    accSkripsi(idBeritaAcara, dospem, penguji1, penguji2, penguji3);
                }
            });
        } else {
            console.error('Error: One or more elements not found.');
        }
    }

    // Fungsi untuk acc skripsi
    function accSkripsi(idBeritaAcara, dospem, penguji1, penguji2, penguji3) {
        const data = {
            dospem: dospem,
            penguji1: penguji1,
            penguji2: penguji2,
            penguji3: penguji3
        };

        // Mengirim data acc ke server
        axios.post(`/dosen/revisi_sidang_skripsi/accrevisi/${idBeritaAcara}`, data)
            .then(function(response) {
                // Menampilkan pesan sukses dan memuat ulang halaman
                Swal.fire({
                    title: 'Revisi Skripsi berhasil diacc!',
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
                Swal.fire({
                    title: 'Terjadi kesalahan',
                    text: 'Gagal memproses permintaan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
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
