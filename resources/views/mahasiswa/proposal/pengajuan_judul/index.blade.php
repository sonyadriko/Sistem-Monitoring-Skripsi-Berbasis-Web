@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet">
@endpush

@section('title')
Pengajuan Tema
@endsection

@section('css')
<link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pengajuan Tema</li>
    </ol>
</nav>
@if(is_null($temacek) || is_null($temacek->status))
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Alur Pengajuan Tema</h4>
          {{-- <p class="text-muted mb-3">Read the <a href="http://www.jquery-steps.com/GettingStarted" target="_blank"> Official jQuery Steps Documentation </a>for a full list of instructions and other options.</p> --}}
          <div id="wizard">
            <h2>First Step</h2>
            <section>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">

                        </div>
                    </div>
                </div>
            </section>

            <h2>Second Step</h2>
            <section>
                <form action="{{ route('pengajuan-judul.submit') }}" method="POST" id="yourFormId">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mahasiswa</label>
                        <input class="form-control" type="text" id="name" name="nama" value="{{ Auth::user()->name }}" readonly autocomplete="nama"/>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM Mahasiswa</label>
                        <input class="form-control" type="text" id="npm" value="{{ Auth::user()->kode_unik }}" name="npm" readonly/>
                        @error('npm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Rencana Tema Proposal Skripsi</label>
                        <textarea class="form-control" id="judul" name="judul" rows="3" placeholder="Masukan rencana tema/judul penelitian"></textarea>
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="bidang_ilmu" class="form-label">Bidang Keilmuan</label>
                        <select class="form-select" id="bidang_ilmu" name="bidang_ilmu" aria-label="Default select example">
                            <option value="" selected disabled="">Pilih Bidang Keilmuan</option>
                            @foreach($bidang_ilmu as $bi)
                                <option value="{{ $bi->id_bidang_ilmu }}">{{ $bi->topik_bidang_ilmu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah Pilihan Semester VII</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Audit SI-TI" name="mata_kuliah[]" id="audit_si_ti">
                            <label class="form-check-label" for="audit_si_ti">Audit SI-TI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Recommender System" name="mata_kuliah[]" id="recommender_system">
                            <label class="form-check-label" for="recommender_system">Recommender System</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Business Intelligence" name="mata_kuliah[]" id="business_intelligence">
                            <label class="form-check-label" for="business_intelligence">Business Intelligence</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Perencanaan Strategis SI-TI" name="mata_kuliah[]" id="perencanaan_strategis_si_ti">
                            <label class="form-check-label" for="perencanaan_strategis_si_ti">Perencanaan Strategis SI-TI</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah Pilihan Semester VIII</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Manajemen Kualitas SI/TI" name="mata_kuliah[]" id="manajemen_kualitas_si_ti">
                            <label class="form-check-label" for="manajemen_kualitas_si_ti">Manajemen Kualitas SI/TI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Model dan Simulasi Sistem" name="mata_kuliah[]" id="model_dan_simulasi_sistem">
                            <label class="form-check-label" for="model_dan_simulasi_sistem">Model dan Simulasi Sistem</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Rekayasa Kebutuhan" name="mata_kuliah[]" id="rekayasa_kebutuhan">
                            <label class="form-check-label" for="rekayasa_kebutuhan">Rekayasa Kebutuhan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Sistem Informasi Intelegensia" name="mata_kuliah[]" id="sistem_informasi_intelegensia">
                            <label class="form-check-label" for="sistem_informasi_intelegensia">Sistem Informasi Intelegensia</label>
                        </div>
                    </div>
                </form>
            </section>

          </div>
        </div>
      </div>
    </div>
    </div>
</div>
<!-- end row -->
@else
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Alur Pengajuan Tema</h4>
            </div>
            <div class="card-body">
                {{-- <h6 class="card-title">Form Grid</h6> --}}
                <h4 class="card-title mb-0">Selamat! Pengajuan Tema Proposal Skripsimu Sudah disubmit.</h4>
                <h6 class="mb-3">Selanjutnya menunggu konfirmasi dan pembagian dosen dari koordinator, berikut isi dari pengajuan yang anda lakukan.</h4>
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Enter first name" value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">NPM</label>
                                <input type="text" class="form-control" placeholder="Enter last name" value="{{ Auth::user()->kode_unik }}" readonly>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Bidang Ilmu</label>
                                <input type="text" class="form-control" placeholder="Enter first name" value="{{ $temacek->topik_bidang_ilmu }}" readonly>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control @if($temacek->status == 'pending') bg-warning @elseif($temacek->status == 'terima') bg-success @endif" placeholder="Enter last name" value="{{ $temacek->status }}" readonly>
                            </div>
                        </div>
                    </div><!-- Row -->
                </form>
                {{-- <button type="button" class="btn btn-primary submit">Submit form</button> --}}
            </div>

            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endif
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
      // Gunakan SweetAlert untuk menampilkan pesan konfirmasi sederhana
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to save changes?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika pengguna mengklik "Yes," panggil fungsi saveChanges
          saveChanges();
        }
      });
    }

    // Fungsi untuk menyimpan perubahan
    function saveChanges() {
      // Anda dapat menambahkan logika untuk menyimpan perubahan ke server di sini
      var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID sebenarnya dari formulir Anda

      // Standard form submission
      form.submit();
    }
  });
</script>
@endpush
