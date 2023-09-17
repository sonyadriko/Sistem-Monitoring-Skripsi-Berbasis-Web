@extends('layouts/template')

@section('title')
Bimbingan Proposal
@endsection

<link rel="stylesheet" href="{{asset('/css/custom.css')}}" />

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- @if($dosens && is_null($dosens->id_bimbingan_proposal))
        <div class="alert alert-warning" role="alert">
            Harap ajukan judul terlebih dahulu sebelum melanjutkan.
        </div>
    @endif --}}
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
                    <form action="{{route('bimbingan-mhs.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="file_proposal" class="form-label">Upload File Proposal</label>
                        <input class="form-control" type="file" id="file_proposal" name="file_proposal" id="slip_file" />
                    </div>
                    {{-- <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Keterangan</label>
                        <input
                          type="text"
                          class="form-control"
                          id="komentar"
                          name="komentar"
                          placeholder="komentar..."
                          aria-describedby="defaultFormControlHelp"
                        />
                    </div> --}}
                    <input type="hidden" name="bimbingan_proposal_id" value="{{$dosens->id_bimbingan_proposal}}"/>
                    <div class="d-flex justify-content-between mt-4">
                        {{-- <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <h5 class="card-header">Persetujuan Seminar</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="col-md">
                            {{-- <small class="text-bold fw-semibold">Mata Kuliah Pilihan Semester VIII</small> --}}
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="manajemen_kualitas" name="mk_pilihan[]" id="defaultCheck5" />
                                <label class="form-check-label" for="defaultCheck5"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck6" />
                                <label class="form-check-label" for="defaultCheck6"> Dosen Pembimbing 2 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary" disabled>Daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
    <button type="submit" class="btn btn-primary">History Bimbingan</button>
    </div>
   
    @endif
</div>
@endsection