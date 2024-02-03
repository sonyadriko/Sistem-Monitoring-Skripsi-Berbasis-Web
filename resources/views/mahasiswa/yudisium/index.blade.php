@extends('layout.master')

@section('title')
Daftar Yudisium
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
        <li class="breadcrumb-item active" aria-current="page">Yudisium</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Alur Pendaftaran Yudisium</h4>
                <div id="wizard">
                    <h2>Step Pertama</h2>
                    <section>
                        <div class="row">
                            <div class="card-group">
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step1.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Mempersiapkan File</h5>
                                    <p class="card-text text-center">File skripsi yang sudah diacc, file surat tugas bimbingan, slip asli pembayaran bimbingan skripsi.</p>
                                </div>
                                </div>
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step2.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Mengisi Form Daftar Sidang   </h5>
                                    <p class="card-text text-center">Melakukan pengisian form pengajuan proposal, lalu menunggu konfirmasi koordinator.</p>
                                </div>
                                </div>
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step3.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Menunggu Jadwal</h5>
                                    <p class="card-text text-center">Menunggu jadwal sidang dari koordinator skripsi.</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h2>Step Kedua</h2>
                    <section>
                        <form action="{{route('yudisium-store')}}" method="POST" enctype="multipart/form-data" id="yourFormId">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="text" class="form-control" id="npm" value="{{Auth::user()->kode_unik}}" name="npm" aria-describedby="defaultFormControlHelp"readonly/>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{Auth::user()->name}}" aria-describedby="defaultFormControlHelp" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_surat_tugas" class="form-label">Tanggal Surat Tugas Awal</label>
                                <input class="form-control @error('tanggal_surat_tugas') is-invalid @enderror" name="tanggal_surat_tugas" type="date" id="tanggal_surat_tugas" />
                                @error('tanggal_surat_tugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_sidang_skripsi" class="form-label">Tanggal Sidang Skripsi</label>
                                <input class="form-control @error('tanggal_sidang_skripsi') is-invalid @enderror" name="tanggal_sidang_skripsi" type="date" id="tanggal_sidang_skripsi" />
                                @error('tanggal_sidang_skripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="skor_tefl" class="form-label">Skor TEFL</label>
                                <input type="text" class="form-control" name="skor_tefl" id="skor_tefl" placeholder="Skor TEFL..."  aria-describedby="defaultFormControlHelp" />
                            </div>
                            <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                            {{-- <input type="hidden" name="id_bimbingan_skripsi" value="{{$datas->id_bimbingan_skripsi}}"> --}}
                            <div class="mb-3">
                                <label for="sertifikat_tefl" class="form-label">Upload File Sertifikat TEFL</label>
                                <input class="form-control" type="file" name="sertifikat_tefl" id="sertifikat_tefl" />
                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                @error('serti_file')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
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
<script>
    $(function() {
    'use strict';

    $("#wizard").steps({
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      onStepChanging: function (event, currentIndex, newIndex) {
        // Validasi data di setiap langkah jika diperlukan
        return true; // Kembalikan true jika data valid
      },
      onFinished: function (event, currentIndex) {
        // Tampilkan konfirmasi sebelum menyimpan perubahan
        showConfirmation();
      }
    });
    function showConfirmation() {
    // Check if both files are uploaded
            var proposalFile = $('#sertifikat_tefl').val();

            if (proposalFile === '' ) {
                // If either file is not uploaded, show an error message
                Swal.fire({
                    title: 'Error',
                    text: 'Please upload sertifikat file before saving changes.',
                    icon: 'error',
                });
            } else {
                // If both files are uploaded, show the confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Apakah Anda ingin menyimpan perubahan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user clicks "Yes," submit the form
                        saveChanges();
                    }
                });
            }
        }
        function saveChanges() {
            // Gather form data
            var form = $('#yourFormId')[0]; // Replace 'yourFormId' with the actual ID of your form
            form.submit();
        }
});
</script>
@endpush
