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
<div class="row">
    <div class="col-lg-12">
        @if (is_null($datas) || is_null($datas->id_bimbingan_proposal))
        <div class="alert alert-warning" role="alert">
            Harap melakukan pengajuan tema terlebih dahulu.
        </div>
        @else
            @if ($datas->dosen_pembimbing_ii == 'tidak ada' && is_null($datas->acc_dosen_utama))
                <div class="alert alert-warning" role="alert">
                    Harap mendapatkan acc dari dosen pembimbing terlebih dahulu.
                </div>
            @elseif ($datas->status == 'pending')
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
            @elseif ($datas->status == 'terima')
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
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Jadwal Seminar Proposal Skripsi.</h4>
                </div>
                <div class="card-body">
                    {{-- <h6 class="card-title">Form Grid</h6> --}}
                    <table class="table table-borderless datatables-basic"/>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>NPM</td>
                                    <td>{{$datas->kode_unik}}</td>
                                    @php
                                        $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal);
                                        $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                    @endphp
                                    <td>Hari Tanggal</td>
                                    <td>{{$formatTanggal}}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{$datas->name}}</td>
                                    <td>Waktu</td>
                                    <td>{{$datas2->jam}}</td>
                                </tr>
                                <tr>
                                    <td>Tema / Judul</td>
                                    <td>{{$datas->judul}}</td>
                                    <td>Ruang</td>
                                    <td>{{$datas2->nama_ruangan}}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing 1</td>
                                    <td>{{$datas->dosen_pembimbing_utama}}</td>
                                    <td>Dosen Pembimbing 2</td>
                                    <td>{{$datas->dosen_pembimbing_ii}}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Penguji</td>
                                    <td>{{$datas2->nama_penguji_1}} (Dosen Penguji 1)<br/>
                                        {{$datas2->nama_penguji_2}} (Dosen Penguji 2)
                                    </td>
                                    <td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>

            @else
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Alur Pendaftaran Seminar Proposal Skripsi</h4>
                    {{-- <p class="text-muted mb-3">Read the <a href="http://www.jquery-steps.com/GettingStarted" target="_blank"> Official jQuery Steps Documentation </a>for a full list of instructions and other options.</p> --}}
                    <div id="wizard">
                        <h2>Step Pertama</h2>
                        <section>
                            <div class="row">
                                <div class="card-group">
                                    <div class="card">
                                    <img src="{{ url('img/wizard/seminar/step1.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Memilih Bidang Ilmu</h5>
                                        <p class="card-text text-center">Mahasiswa dapat memilih tema / judul sesuai dengan bidang ilmu yang tersedia.</p>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <img src="{{ url('img/wizard/seminar/step2.svg') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">Memilih Bidang Ilmu</h5>
                                        <p class="card-text text-center">Melakukan pengisian form pengajuan proposal, lalu menunggu konfirmasi koordinator.</p>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <img src="{{ url('img/wizard/seminar/step3.svg') }}" class="card-img-top" alt="...">
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
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">
                                <div class="mb-3">
                                    <label for="proposal_file" class="form-label">Upload File Proposal Skripsi</label>
                                    <input class="form-control" type="file" name="proposal_file" id="proposal_file" />
                                    <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
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
                                {{-- <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div> --}}
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
        var form = $('#yourFormId')[0]; // Replace 'yourFormId' with the actual ID of your form

        // Standard form submission
        form.submit();
    }
});
</script>
@endpush

