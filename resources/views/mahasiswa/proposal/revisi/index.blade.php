@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Revisi Sidang Proposal
@endsection


@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Revisi Sidang Proposal</h4>
  </div>

</div>
{{-- <h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6> --}}

<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
    @if(is_null($revisisp) || (is_null($revisisp->id_berita_acara_p)) || (is_null($revisisp->id_revisi_seminar_proposal)))
        <div class="alert alert-warning" role="alert">
            Harap mendaftar sidang proposal terlebih dahulu. / Revisi belum dicetak oleh koordinator.
        </div>
    @else
    <div class="card mb-4">
        <h5 class="card-header">Review Sidang Proposal</h5>
        <div class="card-body">
            <p class="revisi-rumusan-masa">
                <span class="span0-1">Revisi : <br/></span>
                @if (!is_null($detailrev))
                    @if(is_null($detailrev->revisi))
                        <span class="span0-1 alert alert-warning">Menunggu review dari dosen</span><br>
                    @else
                        <span class="span0-1">{{ $detailrev->revisi }} </span><br>
                    @endif
                @else
                    <span class="span0-1 alert alert-warning">Menunggu review dari dosen</span><br>
                @endif



                @foreach($revisisp2 as $revisisp2)
                <span class="span0-1">{{$revisisp2->revisi}} dari {{$revisisp2->name}}</span></br>
                @endforeach
            </p>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-xl-6">
            <div class="card mb-4 mb-xl-0">
                <h5 class="card-header">File Revisi Proposal</h5>
                <div class="card-body">
                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file_revisi_proposal" class="form-label">Upload File Revisi Proposal</label>
                            <input class="form-control" type="file" id="file_revisi_proposal" name="file_revisi_proposal" />
                            <p class="text-danger"> File : PDF | Size Max : 5MB.</p>
                            @error('file_revisi_proposal')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" id="berita_acara_id" name="berita_acara_id" value="{{ $revisisp->id_revisi_seminar_proposal }}" />
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-6">
            <div class="card mb-4">
                <h5 class="card-header">Acc Revisi Sidang Proposal</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" name="dospem" id="dospem" {{ $revisisp->acc_dospem  ? 'checked disabled' : '' }} disabled/>
                            <label class="form-check-label" for="dospem"> Dosen Pembimbing </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="dosenpenguji1" id="dosenpenguji1" {{ $revisisp->acc_penguji_1  ? 'checked disabled' : '' }} disabled/>
                            <label class="form-check-label" for="dosenpenguji1"> Dosen Penguji 1 </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="dosenpenguji2" id="dosenpenguji2" {{ $revisisp->acc_penguji_2  ? 'checked disabled' : '' }} disabled/>
                            <label class="form-check-label" for="dosenpenguji2"> Dosen Penguji 2 </label>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            @if(is_null($revisisp->acc_dospem) || is_null($revisisp->acc_penguji_1) || is_null($revisisp->acc_penguji_2))
                            <button type="submit" class="btn btn-inverse-danger" disabled">
                                Belum bisa pengajuan surat tugas
                            </button>
                            @else
                            {{-- <button type="submit" class="btn btn-primary" {{ ($dosens->acc_dosen_utama && $dosens->acc_dosen_ii) ? '' : 'disabled' }}>Daftar</button>{{ route('seminar-proposal.create')}} --}}
                            <button type="submit" class="btn btn-inverse-success" onclick="handleButtonClick()">
                                Daftar Surat Tugas
                            </button>
                            @endif
                        </div>
                        {{-- <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <a href="{{ route('his-rev-pro.index') }}" class="btn btn-primary mt-4">History Revisi Sidang Proposal</a>
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
            window.location.href = "{{ route('pengajuan-st.check') }}";
        // }
    }
    // Pastikan elemen sudah dimuat di dalam DOM
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');

        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const file = document.getElementById('file_revisi_proposal').files[0];
                const berita_acara_id = document.getElementById('berita_acara_id').value;

                if (file && berita_acara_id) {
                    const formData = new FormData();
                    formData.append('file_revisi_proposal', file);
                    formData.append('berita_acara_id', berita_acara_id);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('revisi_sp.store') }}', {
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
                                title: 'File Revisi Proposal Berhasil disubmit.',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                // location.reload();
                                window.location.href = "{{ route('revisi_sp.index') }}";
                            });
                        } else {
                            // Handle validation errors or other errors
                            if (data.errors) {
                                // Display validation errors in the form
                                Object.keys(data.errors).forEach(field => {
                                    const errorElement = document.getElementById(field + '-error');
                                    if (errorElement) {
                                        errorElement.innerHTML = data.errors[field][0];
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message
                                });
                            }
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
