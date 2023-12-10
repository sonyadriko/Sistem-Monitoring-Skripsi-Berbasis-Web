@extends('layout.master3')

@section('title')
Daftar Sidang Skripsi
@endsection

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        @if(is_null($datas) || is_null($datas->id_bimbingan_skripsi))
        <div class="alert alert-warning" role="alert">
            Harap menyelesaikan tahap proposal terlebih dahulu.
        </div>
        @else
            @if($datas->dosen_pembimbing_ii == 'tidak ada' && is_null($datas->acc_dosen_utama))
            <div class="alert alert-warning" role="alert">
                Harap melakukan pengajuan judul terlebih dahulu.
            </div>
            @elseif($datas->status == 'pending')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Seminar Proposal </h4>
                </div>
                <div class="card-body">
                    {{-- <h6 class="card-title">Form Grid</h6> --}}
                    <h4 class="card-title mb-0">Pendaftaran Seminar Propoasl Skripsi telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dibuatkan jadwal.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-secondary" role="alert">
                            Tunggu diperiksa koordinator.
                        </div>
                    </h4>
                </div>
            </div>
            @elseif($datas->status == 'terima')
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Seminar Proposal </h4>
                </div>
                <div class="card-body">
                    {{-- <h6 class="card-title">Form Grid</h6> --}}
                    <h4 class="card-title mb-0">Pendaftaran Seminar Propoasl Skripsi telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dibuatkan jadwal.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-success" role="alert">
                            Selamat.
                        </div>
                    </h4>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pendaftaran Sidang Skripsi</h4>
                </div>
                <div class="card-body">
                    <h6 class="mb-4">Langkah-langkah yang harus dilalui saat ingin melakukan pendaftaran sidang skripsi.</h6>

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
                                    <p class="card-title-desc">Membaca urutan dari apa yang harus dilakukan dan dipersiapkan untuk melakukan pendaftaran sidang skripsi skripsi terdapat pada gambar dibawah ini.</p>
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
                                        <p class="card-title-desc">Melakukan pengisian form pendaftaran seminar dibawah ini.</p>
                                    </div>
                                    <form action="{{route('sidang_skripsi.store')}}" method="POST" enctype="multipart/form-data" id="yourFormId">
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
                                            <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                            <input type="text" class="form-control" id="dospem1" value="{{$datas->dosen_pembimbing_utama}}" placeholder="Dosen Pembimbing 1" aria-describedby="defaultFormControlHelp" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                            <input type="text" class="form-control" id="dospem2" placeholder="Dosen Pembimbing 2" value="{{$datas->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
                                        </div>
                                        {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                                        <input type="hidden" name="id_bimbingan_skripsi" value="{{$datas->id_bimbingan_skripsi}}">
                                        <div class="mb-3">
                                            <label for="skripsi_file" class="form-label">Upload File Skripsi</label>
                                            <input class="form-control" type="file" name="skripsi_file" id="skripsi_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('skripsi_file')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slip_file" class="form-label">Upload File Slip Pembayaran Sidang Skripsi</label>
                                            <input class="form-control" type="file" name="slip_file" id="slip_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('slip_file')
                                            <div class="text-danger">{{ $message }}</div>
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
            @endif
            <!-- end card -->
        @endif
    </div>
    <!-- end col -->
</div>


{{-- !-- row --> --}}
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
    // Check if both files are uploaded
            var proposalFile = $('#skripsi_file').val();
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
            var form = $('#yourFormId')[0]; // Replace 'yourFormId' with the actual ID of your form
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
