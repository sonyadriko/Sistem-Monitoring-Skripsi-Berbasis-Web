@extends('layout.master3')
@section('title')Pengajuan Surat Tugas @endsection
@push('plugin-styles')
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet">
@endpush
@section('css')
<link href="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
    </ol>
</nav>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        @if(is_null($datas) || is_null($datas->acc_dospem))
        <div class="alert alert-warning" role="alert">
            Harap mendapatkan acc revisi proposal dari dosen pembimbing terlebih dahulu.
        </div>
        @elseif(is_null($datas->acc_penguji_1))
        <div class="alert alert-warning" role="alert">
            Harap mendapatkan acc revisi proposal dari dosen penguji 1 terlebih dahulu.
        </div>
        @elseif(is_null($datas->acc_penguji_2))
        <div class="alert alert-warning" role="alert">
            Harap mendapatkan acc revisi proposal dari dosen penguji 2 terlebih dahulu.
        </div>
        @else
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Alur Pengajuan Surat Tugas</h4>
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
                                <p class="card-title-desc">Membaca urutan dari apa yang harus dilakukan dan dipersiapkan untuk melakukan pengajuan surat tugas bimbingan terdapat pada gambar dibawah ini.</p>
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
                                    <p class="card-title-desc">Fill all information below</p>
                                </div>
                                <form action="{{route('pengajuan-st.store')}}" method="POST" enctype="multipart/form-data"  id="yourFormId">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="judulskripsi" class="form-label">Judul Skripsi</label>
                                        <input class="form-control" type="text" id="judulskripsi" value="{{$datas->topik_bidang_ilmu}}" name="judulskripsi" placeholder="Masukan Dosen Pembimbing 1..." readonly />
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
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">
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
    </div>
    <!-- end col -->
</div>

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
