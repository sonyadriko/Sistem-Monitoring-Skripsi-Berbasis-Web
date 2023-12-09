@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
{{-- <link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet"> --}}
@endpush

@section('title')
Pengajuan Tema
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
            <h2>Step Pertama</h2>
            <section>
                <div class="row">
                    <div class="card-group">
                        <div class="card">
                          <img src="{{ url('img/wizard/pengajuan_judul/step1.svg') }}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title text-center">Memilih Bidang Ilmu</h5>
                            <p class="card-text text-center">Mahasiswa dapat memilih tema / judul sesuai dengan bidang ilmu yang tersedia.</p>
                          </div>
                        </div>
                        <div class="card">
                          <img src="{{ url('img/wizard/pengajuan_judul/step2.svg') }}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title text-center">Memilih Bidang Ilmu</h5>
                            <p class="card-text text-center">Melakukan pengisian form pengajuan proposal, lalu menunggu konfirmasi koordinator.</p>
                          </div>
                        </div>
                        <div class="card">
                          <img src="{{ url('img/wizard/pengajuan_judul/step3.svg') }}" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title text-center">Memilih Bidang Ilmu</h5>
                            <p class="card-text text-center">Selamat! Pengajuan yang anda lakukan telah diterima.</p>
                          </div>
                        </div>
                    </div>
                </div>
            </section>

            <h2>Step Kedua</h2>
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
                        <p class="text-danger"> Maksimal 12 kata.</p>

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
                            <input class="form-check-input" type="checkbox" value="Enterprise Resource Planning" name="mata_kuliah[]" id="erp">
                            <label class="form-check-label" for="erp">Enterprise Resource Planning</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Framework Tata Kelola IT" name="mata_kuliah[]" id="FTKIT">
                            <label class="form-check-label" for="FTKIT">Framework Tata Kelola IT</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Inovasi SI dan Teknologi Terbaru" name="mata_kuliah[]" id="ISITT">
                            <label class="form-check-label" for="ISITT">Inovasi SI dan Teknologi Terbaru</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Recommender System" name="mata_kuliah[]" id="recommender_system">
                            <label class="form-check-label" for="recommender_system">Recommender System</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Teknik Peramalan" name="mata_kuliah[]" id="teknik_peramalan">
                            <label class="form-check-label" for="teknik_peramalan">Teknik Peramalan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Business Intelligence" name="mata_kuliah[]" id="business_intelligence">
                            <label class="form-check-label" for="business_intelligence">Business Intelligence</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Perencanaan Strategis SI-TI" name="mata_kuliah[]" id="perencanaan_strategis_si_ti">
                            <label class="form-check-label" for="perencanaan_strategis_si_ti">Perencanaan Strategis SI-TI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Manajemen Layanan" name="mata_kuliah[]" id="manajemen_layanan_si_ti">
                            <label class="form-check-label" for="manajemen_layanan_si_ti">Manajemen Layanan SI-TI</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah Pilihan Semester VIII</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Manajemen Kualitas SI/TI" name="mata_kuliah[]" id="manajemen_kualitas_si_ti">
                            <label class="form-check-label" for="manajemen_kualitas_si_ti">Manajemen Kualitas SI/TI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Manajemen Resiko SI/TI" name="mata_kuliah[]" id="manajemen_resiko_si_ti">
                            <label class="form-check-label" for="manajemen_resiko_si_ti">Manajemen Resiko SI/TI</label>
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Testing dan Implementasi SI" name="mata_kuliah[]" id="testing_dan_implementasi_si">
                            <label class="form-check-label" for="sistem_informasi_intelegensia">Testing dan Implementasi SI</label>
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
