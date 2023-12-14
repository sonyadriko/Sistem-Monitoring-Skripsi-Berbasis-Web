@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
{{-- <link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet"> --}}
@endpush

@section('title')
Pengajuan Surat Tugas
@endsection

@section('css')
{{-- <link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
    <style>
        .wizard > .content {
            min-height: 50em; /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
        }
    </style>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
        </ol>
    </nav>
        <div class="row">
            <div class="container-xxl flex-grow-1 container-p-y">
                @if (is_null($datas) || is_null($datas->acc_dospem))
                    <div class="alert alert-warning" role="alert">
                        Harap mendapatkan acc revisi proposal dari dosen pembimbing terlebih dahulu.
                    </div>
                @elseif (is_null($datas->acc_penguji_1))
                    <div class="alert alert-warning" role="alert">
                        Harap mendapatkan acc revisi proposal dari dosen penguji 1 terlebih dahulu.
                    </div>
                @elseif (is_null($datas->acc_penguji_2))
                    <div class="alert alert-warning" role="alert">
                        Harap mendapatkan acc revisi proposal dari dosen penguji 2 terlebih dahulu.
                    </div>
                @else
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Alur Pengajuan Surat Tugas</h4>
                                <div id="wizard">
                                    <h2>Step Pertama</h2>
                                    <section>
                                        <div class="row">
                                            <div class="card-group">
                                                <div class="card">
                                                <img src="{{ url('img/wizard/surat_tugas/step1.svg') }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Mempersiapkan File</h5>
                                                    <p class="card-text text-center">File Proposal yang sudah di acc, slip asli pembayaran.</p>
                                                </div>
                                                </div>
                                                <div class="card">
                                                <img src="{{ url('img/wizard/surat_tugas/step2.svg') }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Mengisi Form Surat Tugas</h5>
                                                    <p class="card-text text-center">Melakukan pengisian form pengajuan surat tugas.</p>
                                                </div>
                                                </div>
                                                <div class="card">
                                                <img src="{{ url('img/wizard/surat_tugas/step3.svg') }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Mengambil Surat Tugas</h5>
                                                    <p class="card-text text-center">Melakukan pengambilan surat tugas di CSR Jurusan.</p>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <h2>Step Kedua</h2>
                                    <section>
                                        <form action="{{route('pengajuan-st.store')}}" method="POST" enctype="multipart/form-data"  id="yourFormId">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="judulskripsi" class="form-label">Judul Skripsi</label>
                                                <input class="form-control" type="text" id="judulskripsi" value="{{$datas->judul}}" name="judulskripsi" placeholder="Masukan Dosen Pembimbing 1..." readonly />
                                                @error('judulskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                                <input class="form-control" type="text" id="dospem1" name="dospem1" value="{{$datas->dosen_pembimbing_utama}}" readonly placeholder="Masukan Dosen Pembimbing 1..."/>
                                                @error('dospem1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                                <input class="form-control" type="text" id="dospem2" name="dospem2" value="{{$datas->dosen_pembimbing_ii}}" readonly placeholder="Masukan Dosen Pembimbing 2..." />
                                                @error('dospem2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Mahasiswa</label>
                                                <input class="form-control" type="text" id="name" name="nama" value="{{Auth::user()->name}}" readonly autocomplete="nama" />
                                                @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                            <label for="npm" class="form-label">NPM Mahasiswa</label>
                                            <input class="form-control" type="text" id="npm" value="{{Auth::user()->kode_unik}}" name="npm" readonly/>
                                                @error('npm')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_sidang_proposal" class="form-label">Tanggal Sidang Proposal Skripsi</label>
                                                <input class="form-control" type="date" name="tanggal_sidang_proposal" id="tanggal_sidang_proposal" />
                                                @error('tanggal_sidang_proposal')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="file_proposal" class="form-label">Upload File Proposal Skripsi</label>
                                                <input class="form-control" type="file" name="file_proposal" id="file_proposal" />
                                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                                @error('file_proposal')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="file_slip_pembayaran" class="form-label">Upload File Slip Pembayaran Surat Tugas</label>
                                                <input class="form-control" type="file" name="file_slip_pembayaran" id="file_slip_pembayaran" />
                                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                                @error('file_slip_pembayaran')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                                            <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection



@section('script')


@endsection


@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('custom-scripts')
  {{-- <script src="{{ asset('assets/js/wizard.js') }}"></script> --}}
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

    // Fungsi untuk menampilkan konfirmasi menggunakan SweetAlert
    function showConfirmation() {
    // Use SweetAlert to show a simple confirmation message
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

    function saveChanges() {
        // Gather form data
        var form = $('#yourFormId')[0]; // Replace 'yourFormId' with the actual ID of your form

        // Standard form submission
        form.submit();
    }
  });
</script>
@endpush
