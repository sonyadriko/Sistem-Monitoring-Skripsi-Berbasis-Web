@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

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

  {{-- <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
      <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
    </div>
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button>
  </div> --}}
</div>
<h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6>
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
                <span class="span0-1">Revisi:<br/></span>
                <span class="span1-1">Rumusan masalah dan tujuan penelitian harus searah. <br/>Perbaiki alur tahapan penelitian (perlu diberikan informasi mengenai populasi dan sampel). <br/>
                    Kurangi penggunaan kata "setelah itu".</span>
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
            <div class="card mb-4">
                <h5 class="card-header">Persetujuan Seminar</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $dosens->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                            <label class="form-check-label" for="defaultCheck5"> Dosen Pembimbing 1 </label>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary" {{ $dosens->acc_dosen_utama ? '' : 'disabled' }}>Daftar</button>
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
                            <label class="form-check-label" for="defaultCheck5"> Dosen Pembimbing 1 </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="persetujuan2" id="persetujuan2" {{ $dosens->acc_dosen_ii ? 'checked disabled' : '' }} disabled />
                            <label class="form-check-label" for="defaultCheck6"> Dosen Pembimbing 2 </label>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            {{-- <button type="submit" class="btn btn-primary" {{ ($dosens->acc_dosen_utama && $dosens->acc_dosen_ii) ? '' : 'disabled' }}>Daftar</button>{{ route('seminar-proposal.create')}} --}}
                            <button type="submit" class="btn btn-primary" onclick="handleButtonClick()">
                                Daftar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="mb-3">
        <a href="{{ route('his-bim-mhs.index') }}" class="btn btn-primary">History Bimbingan</a>


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
        if ({{ $dosens->acc_dosen_utama && $dosens->acc_dosen_ii ? 'true' : 'false' }}) {
            // Redirect to the specified route
            window.location.href = "{{ route('seminar-proposal.create') }}";
        }
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
                                location.reload();
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
