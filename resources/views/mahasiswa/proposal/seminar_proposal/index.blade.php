@extends('layout.master')

@section('title')
    Daftar Sidang Proposal
@endsection

@push('plugin-styles')
    <!-- Menghubungkan stylesheet untuk flatpickr dan jquery-steps -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <style>
        .wizard>.content {
            min-height: 50em;
            /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
        }
    </style>
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Navigasi breadcrumb untuk halaman sidang proposal -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sidang Proposal Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <!-- Pengecekan kondisi untuk menampilkan pesan peringatan -->
            @if (is_null($datas) || is_null($datas->id_bimbingan_proposal))
                <div class="alert alert-warning" role="alert">
                    Harap melakukan pengajuan judul terlebih dahulu.
                </div>
            @else
                <!-- Pengecekan kondisi untuk menampilkan pesan peringatan atau form pendaftaran -->
                @if ($datas->dosen_pembimbing_ii == 'tidak ada' && is_null($datas->acc_dosen_utama))
                    <div class="alert alert-warning" role="alert">
                        Harap mendapatkan acc dari dosen pembimbing terlebih dahulu.
                    </div>
                @else
                    <!-- Kartu yang menampilkan alur pendaftaran sidang proposal -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Alur Pendaftaran Sidang Proposal Skripsi</h4>
                            <div id="wizard">
                                <!-- Langkah pertama dalam wizard -->
                                <h2>Step Pertama</h2>
                                <section>
                                    <div class="row">
                                        <div class="card-group">
                                            <!-- Kartu untuk langkah pertama -->
                                            <div class="card">
                                                <img src="{{ url('img/wizard/seminar/step1.svg') }}" class="card-img-top"
                                                    alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Mempersiapkan File</h5>
                                                    <p class="card-text text-center">File Proposal yang sudah di acc, slip
                                                        asli pembayaran bimbingan skripsi.</p>
                                                </div>
                                            </div>
                                            <!-- Kartu untuk langkah kedua -->
                                            <div class="card">
                                                <img src="{{ url('img/wizard/seminar/step2.svg') }}" class="card-img-top"
                                                    alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Mengisi Form Daftar Seminar</h5>
                                                    <p class="card-text text-center">Melakukan pengisian form pendaftaran
                                                        seminar.</p>
                                                </div>
                                            </div>
                                            <!-- Kartu untuk langkah ketiga -->
                                            <div class="card">
                                                <img src="{{ url('img/wizard/seminar/step3.svg') }}" class="card-img-top"
                                                    alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Menunggu Jadwal</h5>
                                                    <p class="card-text text-center">Menunggu jadwal seminar dari
                                                        koordinator skripsi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Langkah kedua dalam wizard -->
                                <h2>Step Kedua</h2>
                                <section>
                                    <!-- Form untuk pendaftaran sidang proposal -->
                                    <form action="{{ route('seminar-proposal.submit') }}" method="POST"
                                        enctype="multipart/form-data" id="yourFormId">
                                        @csrf
                                        <!-- Input untuk NPM -->
                                        <div class="mb-3">
                                            <label for="npm" class="form-label">NPM</label>
                                            <input type="text" class="form-control" id="npm"
                                                value="{{ Auth::user()->kode_unik }}" name="npm"
                                                aria-describedby="defaultFormControlHelp" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="{{ Auth::user()->name }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                            <input type="text" class="form-control" id="dospem1"
                                                value="{{ $datas->dosen_pembimbing_utama }}"
                                                placeholder="Dosen Pembimbing 1" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                            <input type="text" class="form-control" id="dospem2"
                                                placeholder="Dosen Pembimbing 2" value="{{ $datas->dosen_pembimbing_ii }}"
                                                aria-describedby="defaultFormControlHelp" readonly />
                                        </div>
                                        <!-- Input tersembunyi untuk ID pengguna dan bimbingan proposal -->
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="bimbingan_proposal_id"
                                            value="{{ $datas->id_bimbingan_proposal }}">
                                        <!-- Input untuk mengunggah file proposal -->
                                        <div class="mb-3">
                                            <label for="proposal_file" class="form-label">Upload File Proposal
                                                Skripsi</label>
                                            <input class="form-control" type="file" name="proposal_file"
                                                id="proposal_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('proposal_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Input untuk mengunggah slip pembayaran -->
                                        <div class="mb-3">
                                            <label for="slip_file" the form-label">Upload File Slip Pembayaran Sidang
                                                Proposal</label>
                                            <input class="form-control" type="file" name="slip_file"
                                                id="slip_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('slip_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>


    {{-- !-- row --> --}}
@endsection
@push('plugin-scripts')
    <!-- Menghubungkan script untuk jquery-steps dan sweetalert -->
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
    <script>
        $(function() {
            'use strict';

            // Inisialisasi wizard dengan konfigurasi langkah dan efek transisi
            $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Validasi data di setiap langkah jika diperlukan
                    return true; // Kembalikan true jika data valid
                },
                onFinished: function(event, currentIndex) {
                    // Tampilkan konfirmasi sebelum menyimpan perubahan
                    showConfirmation();
                }
            });

            // Fungsi untuk menampilkan konfirmasi sebelum menyimpan data
            function showConfirmation() {
                var proposalFile = $('#proposal_file').val();
                var slipFile = $('#slip_file').val();

                // Memeriksa apakah file proposal dan slip telah diunggah
                if (proposalFile === '' || slipFile === '') {
                    // Jika salah satu file belum diunggah, tampilkan pesan kesalahan
                    Swal.fire({
                        title: 'Error',
                        text: 'Please upload both proposal and slip files before saving changes.',
                        icon: 'error',
                    });
                } else {
                    // Jika kedua file telah diunggah, tampilkan dialog konfirmasi
                    Swal.fire({
                        title: 'Konfirmasi?',
                        text: 'Apakah Anda ingin menyimpan perubahan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengklik "Yes," kirimkan form
                            saveChanges();
                        }
                    });
                }
            }

            // Fungsi untuk mengirimkan form
            function saveChanges() {
                // Mengumpulkan data form
                var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID form yang sebenarnya

                // Pengiriman form standar
                form.submit();
            }
        });
    </script>
@endpush
