@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Revisi Sidang Skripsi
@endsection


@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Revisi Sidang Skripsi</h4>
  </div>

</div>
{{-- <h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6> --}}

<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(is_null($revisisk) || is_null($revisisk->id_berita_acara_s))
    <div class="alert alert-warning" role="alert">
        Harap mendaftar sidang skripsi terlebih dahulu.
    </div>
    @else
        <div class="card mb-4">
            <h5 class="card-header">Review Sidang Skripsi</h5>
            <div class="card-body">
                <p class="revisi-rumusan-masa">
                    <span class="span0-1">Revisi:<br/></span>

                    @foreach($revisisk2 as $revisi)
                    <span class="span0-1">{{$revisi->revisi}} dari {{$revisi->name}}</span>
                    @endforeach
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 mb-xl-0">
                    <h5 class="card-header">File Revisi Skripsi</h5>
                    <div class="card-body">
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_revisi_skripsi" class="form-label">Upload File Revisi Skripsi</label>
                                <input class="form-control" type="file" id="file_revisi_skripsi" name="file_revisi_skripsi" />
                                <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                @error('file_revisi_skripsi')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" id="berita_acara_id" name="berita_acara_id" value="{{ $revisisk->id_berita_acara_s }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Acc Revisi Skripsi</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="manajemen_kualitas" name="mk_pilihan[]" id="defaultCheck5"/>
                                <label class="form-check-label" for="defaultCheck5"> Dosen Penguji 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck6"/>
                                <label class="form-check-label" for="defaultCheck6"> Dosen Penguji 2 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck7"/>
                                <label class="form-check-label" for="defaultCheck7"> Dosen Penguji 3 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary">History Revisi</button>
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
    // Pastikan elemen sudah dimuat di dalam DOM
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');

        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const file = document.getElementById('file_revisi_skripsi').files[0];
                const berita_acara_id = document.getElementById('berita_acara_id').value;

                if (file && berita_acara_id) {
                    const formData = new FormData();
                    formData.append('file_revisi_skripsi', file);
                    formData.append('berita_acara_id', berita_acara_id);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('revisi_sk.store') }}', {
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
                                title: 'File Skripsi Successfully Submitted!',
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

