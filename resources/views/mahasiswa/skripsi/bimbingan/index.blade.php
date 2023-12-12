@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Bimbingan Skripsi
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Bimbingan Skripsi</h4>
  </div>
</div>
<h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(is_null($bimbingans) || is_null($bimbingans->id_bimbingan_skripsi))
        <div class="alert alert-warning" role="alert">
            Harap selesaikan tahap proposal terlebih dahulu sampai mempunyai surat tugas bimbingan.
        </div>
        @else
        <div class="card mb-4">
            <h5 class="card-header">Review Bimbingan Skripsi</h5>
            <div class="card-body">
                <p class="revisi-rumusan-masa">
                    <span class="span0-1">Revisi:<br/></span>
                    @if (!is_null($detailbim) && !is_null($detailbim->revisi))
                    <span class="span0-1">{{ $detailbim->revisi }}</span><br>
                @else
                    <span class="span0-1 text-danger">Upload file bimbingan terlebih dahulu</span><br>
                @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 mb-xl-0">
                    <h5 class="card-header">File Skripsi</h5>
                    <div class="card-body">
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_skripsi" class="form-label">Upload File Skripsi</label>
                                <input class="form-control" type="file" id="file_skripsi" name="file_skripsi"  />
                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                    @error('file_skripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <input type="hidden" id="bimbingan_skripsi_id" name="bimbingan_skripsi_id" value="{{ $bimbingans->id_bimbingan_skripsi }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($bimbingans->dosen_pembimbing_ii == 'tidak ada')
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Persetujuan Sidang</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $bimbingans->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary" onclick="handleButtonClick()">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Persetujuan Sidang</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $bimbingans->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="persetujuan2" id="persetujuan2" {{ $bimbingans->acc_dosen_ii ? 'checked disabled' : '' }} disabled />
                                <label class="form-check-label" for="persetujuan2"> Dosen Pembimbing 2 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                @if(is_null($bimbingans->acc_dosen_utama) || is_null($bimbingans->acc_dosen_ii))
                                <button type="submit" class="btn btn-secondary" disabled">
                                    Daftar
                                </button>
                                @else
                                {{-- <button type="submit" class="btn btn-primary" {{ ($dosens->acc_dosen_utama && $dosens->acc_dosen_ii) ? '' : 'disabled' }}>Daftar</button>{{ route('seminar-proposal.create')}} --}}
                                <button type="submit" class="btn btn-primary" onclick="handleButtonClick()">
                                    Daftar
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="mb-3">
            <a href="{{ route('his-bims-mhs.index') }}" class="btn btn-primary mt-4">History Bimbingan</a>
        </div>
        @endif
    </div>
</div>





{{-- !-- row --> --}}
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- ... Bagian HTML lainnya ... -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function handleButtonClick() {
        window.location.href = "{{ route('sidang-skripsi.check') }}";
    }
    // Pastikan elemen sudah dimuat di dalam DOM
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');

        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const file = document.getElementById('file_skripsi').files[0];
                const bimbinganSkripsiId = document.getElementById('bimbingan_skripsi_id').value;

                if (file && bimbinganSkripsiId) {
                    const formData = new FormData();
                    formData.append('file_skripsi', file);
                    formData.append('bimbingan_skripsi_id', bimbinganSkripsiId);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('bimbingans-mhs.store') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'File Skripsi Berhasil Disubmit!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                // location.reload();
                                window.location.href = "{{ route('bimbingans-mhs.index') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while submitting the file.'
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please select a file.'
                    });
                }
            });
        } else {
            console.error('Element with ID "submitBtn" not found.');
        }
    });
</script>
