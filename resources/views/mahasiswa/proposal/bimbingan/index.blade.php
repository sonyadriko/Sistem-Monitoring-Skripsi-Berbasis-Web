@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Bimbingan Proposal
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Bimbingan Proposal</h4>
  </div>
</div>
<h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini.</h6>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(is_null($dosens) || is_null($dosens->id_bimbingan_proposal))
        <div class="alert alert-warning" role="alert">
            Harap ajukan judul terlebih dahulu sebelum melanjutkan.
        </div>
        @else
        <div class="card mb-4">
            <h5 class="card-header">Review Bimbingan Proposal</h5>
            <div class="card-body">
                <p class="revisi-rumusan-masa">
                    <span class="span0-1 mt-4 mb-4">Revisi:</span>
                    @if (!is_null($detailbim))
                        @if (is_null($detailbim->revisi))
                            {{-- <span class="span0-1 alert alert-info">Menunggu review dari dosen pembimbing</span><br> --}}
                            <span class="span0-1 alert alert-warning">Menunggu review dari dosen pembimbing</span><br>
                            {{-- <span class="span0-1 alert alert-fill-info">Menunggu review dari dosen pembimbing</span><br> --}}
                        @else
                            <span class="span0-1">{{ $detailbim->revisi }}</span><br>
                        @endif
                    @else
                        <span class="span0-1 alert alert-danger">Upload file bimbingan terlebih dahulu</span><br>
                    @endif
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 mb-xl-0">
                    <h5 class="card-header">File Proposal</h5>
                    <div class="card-body">
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_proposal" class="form-label">Upload File Proposal</label>
                                <input class="form-control" type="file" id="file_proposal" name="file_proposal" id="slip_file" />
                                <p class="text-danger"> File : PDF | Size Max : 5MB.</p>
                                    @error('file_proposal')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <input type="hidden" id="bimbingan_proposal_id" name="bimbingan_proposal_id" value="{{ $dosens->id_bimbingan_proposal }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($dosens->dosen_pembimbing_ii == 'tidak ada')
            <div class="col-xl-6">
                <div class="card mb-4 ">
                    <h5 class="card-header">Persetujuan Seminar</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $dosens->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                @if(is_null($dosens->acc_dosen_utama))
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

            @else
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Persetujuan Seminar</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $dosens->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="persetujuan2" id="persetujuan2" {{ $dosens->acc_dosen_ii ? 'checked disabled' : '' }} disabled />
                                <label class="form-check-label" for="persetujuan2"> Dosen Pembimbing 2 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                @if(is_null($dosens->acc_dosen_utama) || is_null($dosens->acc_dosen_ii))
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
            <a href="{{ route('his-bim-mhs.index') }}" class="btn btn-primary mt-4">History Bimbingan</a>

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
        // Check your conditions here
            // Redirect to the specified route
            window.location.href = "{{ route('seminar-proposal.check') }}";
        // }
    }
    // Pastikan elemen sudah dimuat di dalam DOM
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');

        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const file = document.getElementById('file_proposal').files[0];
                const bimbinganProposalId = document.getElementById('bimbingan_proposal_id').value;

                if (file && bimbinganProposalId) {
                    const formData = new FormData();
                    formData.append('file_proposal', file);
                    formData.append('bimbingan_proposal_id', bimbinganProposalId);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('bimbingan-mhs.store') }}', {
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
                                title: 'File Proposal Successfully Submitted!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                // location.reload();
                                window.location.href = "{{ route('bimbingan-mhs.index') }}";

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
