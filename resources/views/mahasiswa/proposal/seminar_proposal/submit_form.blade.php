@extends('layout.master')

@section('title')
Daftar Seminar Proposal
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
      <li class="breadcrumb-item active" aria-current="page">Seminar Proposal Skripsi</li>
    </ol>
</nav>

@if ($proposalData->seminar_status == 'tolak')
    <div class="alert alert-danger" role="alert">
        <strong>Pengajuan ditolak!</strong><br>
        Alasan Penolakan: {{ $proposalData->alasan_penolakan }}
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Alur Pendaftaran Seminar Proposal Skripsi</h4>
                <div id="wizard">
                    <h2>Step Pertama</h2>
                    <section>
                        <div class="row">
                            <div class="card-group">
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step1.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Mempersiapkan File</h5>
                                    <p class="card-text text-center">File Proposal yang sudah di acc, slip asli pembayaran bimbingan skripsi.</p>
                                </div>
                                </div>
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step2.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Mengisi Form Daftar Seminar</h5>
                                    <p class="card-text text-center">Melakukan pengisian form pendaftaran seminar.</p>
                                </div>
                                </div>
                                <div class="card">
                                <img src="{{ url('img/wizard/seminar/step3.svg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Menunggu Jadwal</h5>
                                    <p class="card-text text-center">Menunggu jadwal seminar dari koordinator skripsi</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h2>Step Kedua</h2>
                    <section>
                        <form action="{{route('seminar-proposal.submit')}}" method="POST" enctype="multipart/form-data" id="yourFormId">
                            @csrf
                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="text" class="form-control" id="npm" value="{{Auth::user()->kode_unik}}" name="npm" aria-describedby="defaultFormControlHelp" readonly/>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{Auth::user()->name}}" aria-describedby="defaultFormControlHelp" readonly/>
                            </div>
                            <div class="mb-3">
                                <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                <input type="text" class="form-control" id="dospem1" value="{{$datas->dosen_pembimbing_utama}}" placeholder="Dosen Pembimbing 1" aria-describedby="defaultFormControlHelp" readonly/>
                            </div>
                            <div class="mb-3">
                                <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                <input type="text" class="form-control" id="dospem2" placeholder="Dosen Pembimbing 2" value="{{$datas->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly/>
                            </div>
                            <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">
                            <div class="mb-3">
                                <label for="proposal_file" class="form-label">Upload File Proposal Skripsi</label>
                                <input class="form-control" type="file" name="proposal_file" id="proposal_file" />
                                <p class="text-danger"> File : PDF | Size Max : 5MB.</p>
                                @error('proposal_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slip_file" class="form-label">Upload File Slip Pembayaran Seminar Proposal</label>
                                <input class="form-control" type="file" name="slip_file" id="slip_file" />
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
        var proposalFile = $('#proposal_file').val();
        var slipFile = $('#slip_file').val();

        if (proposalFile === '' || slipFile === '') {
            // If either file is not uploaded, show an error message
            Swal.fire({
                title: 'Error',
                text: 'Please upload both proposal and slip files before saving changes.',
                icon: 'error',
            });
        } else {
            // If both files are uploaded, show the confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save changes?',
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
        var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID sebenarnya formulir Anda
        var formData = new FormData(form);

        // Menggunakan AJAX untuk mengirim formulir
        $.ajax({
            type: 'POST',
            url: form.action,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
            // Display success message
                Swal.fire({
                    title: 'Pendaftaran Sukses!',
                        text: 'Pendaftaran seminar proposal berhasil!',
                        icon: 'success',
                }).then((result) => {
                    // Redirect to /dashboard after pressing "OK"
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = '/dashboard';
                    }
                });
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika respons dari server mengandung kesalahan
                var errorResponse = xhr.responseJSON;

                if (errorResponse && errorResponse.errors) {
                    // Jika terdapat kesalahan validasi dari server, tampilkan pesan kesalahan
                    var errorMessage = Object.values(errorResponse.errors).flat().join('<br>');
                    Swal.fire({
                        title: 'Error',
                        html: errorMessage,
                        icon: 'error',
                    });
                } else {
                    // Jika kesalahan bukan karena validasi, tampilkan pesan kesalahan umum
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while processing your request. Please try again.',
                        icon: 'error',
                    });
                }
            }
        });
    }


});
</script>
@endpush

