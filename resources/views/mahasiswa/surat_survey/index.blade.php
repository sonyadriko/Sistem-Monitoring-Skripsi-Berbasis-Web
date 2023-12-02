@extends('layout.master3')

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
      <li class="breadcrumb-item active" aria-current="page">Surat Survey Perusahaan</li>
    </ol>
</nav>
{{-- @if(is_null($ss) || is_null($ss->id_bimbingan_proposal)) --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Alur Pengajuan Surat Survey</h4>
            </div>
            <div class="card-body">
                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav d-flex justify-content-center">
                        <li class="nav-item">
                            <a href="#seller-details" class="nav-link disable-click" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Step Pertama">
                                    <i class="bx bx-list-ul"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bank-detail" class="nav-link disable-click" data-toggle="tab">
                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Step Kedua">
                                    <i class="bx bxs-bank"></i>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <!-- wizard-nav -->
                    <div class="tab-content twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="seller-details">
                            <div class="text-center mb-4">
                                <h5>Step Pertama</h5>
                                <p class="card-title-desc">Membaca urutan dari apa yang harus dilakukan dan dipersiapkan untuk melakukan pengajuan surat survey perusahaan terdapat pada gambar dibawah ini.</p>
                            </div>
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

                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" >Next <i
                                            class="bx bx-chevron-right ms-1"></i></a></li>
                            </ul>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane" id="bank-detail">
                            <div>
                                <div class="text-center mb-4">
                                    <h5>Step Kedua</h5>
                                    <p class="card-title-desc">Melakukan pengisian form pendaftaran surat survey dibawah ini.</p>
                                </div>
                                <!-- Inside your form in the "bank-detail" tab -->
                                <form action="{{ route('surat-survey.store') }}" method="POST" id="yourFormId">
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
                                        <label for="tema" class="form-label">Judul / Tema</label>
                                        <input class="form-control" type="text" id="tema" value="{{ $ss->topik_bidang_ilmu }}" name="tema" readonly/>
                                        @error('tema')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input class="form-control" type="text" id="nama_perusahaan" name="nama_perusahaan"/>
                                        @error('nama_perusahaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_penerima" class="form-label">Nama Penerima Surat (Nama Lengkap)</label>
                                        <input class="form-control" type="text" id="nama_penerima" name="nama_penerima"/>
                                        @error('nama_penerima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                        <input class="form-control" type="text" id="alamat_perusahaan" name="alamat_perusahaan"/>
                                        @error('alamat_perusahaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing Utama</label>
                                        <input class="form-control" type="text" id="dosen_pembimbing" value="{{ $ss->dosen_pembimbing_utama }}" name="dosen_pembimbing" readonly/>
                                        @error('dosen_pembimbing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" value="{{$ss->id_bimbingan_proposal}}" name="bimbingan_proposal_id" id="bimbingan_proposal_id" />
                                    <div class="mb-3">
                                        <label for="durasi_survey" class="form-label">Durasi Survey Data untuk Penelitian (Bulan)</label>
                                        <select class="form-select" id="durasi_survey" name="durasi_survey">
                                            <option value="1">1 Bulan</option>
                                            <option value="2">2 Bulan</option>
                                            <option value="3">3 Bulan</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                        @error('durasi_survey')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </form>

                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" onclick="showConfirmation()">Save
                                            Changes</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- tab pane -->
                    </div>
                    <!-- end tab content -->
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
{{-- @else --}}
{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Alur Pengajuan Tema</h4>
            </div>
            <div class="card-body">
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
            </div>

            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div> --}}
<!-- end row -->
{{-- @endif --}}
@endsection

@section('script')
    <script src="{{ URL::asset('assets2/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Your existing nextTab function in the global scope
        function nextTab() {
            var nextTab = $('.nav-item.active').next('li.nav-item');
            if (nextTab.length > 0) {
                nextTab.find('a.nav-link').click();
            }
        }

        // Your existing previousTab function in the global scope
        function previousTab() {
            var prevTab = $('.nav-item.active').prev('li.nav-item');
            if (prevTab.length > 0) {
                prevTab.find('a.nav-link').click();
            }
        }

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




        $(document).ready(function () {
            // Initialize the wizard
            $('#basic-pills-wizard').bootstrapWizard({
                // Options and configurations for the wizard
                // ...

                onTabClick: function (tab, navigation, index) {
                    // Handle tab click event if needed
                    return true;
                },

                onNext: function (tab, navigation, index) {
                    // Handle next button click event if needed
                    return true; // Return false to prevent moving to the next tab
                },

                onPrevious: function (tab, navigation, index) {
                    // Handle previous button click event if needed
                    return true; // Return false to prevent moving to the previous tab
                },

                onTabShow: function (tab, navigation, index) {
                    // Handle tab show event if needed
                }
            });
        });
    </script>
@endsection
