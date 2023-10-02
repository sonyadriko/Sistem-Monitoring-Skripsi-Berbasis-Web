@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @if(is_null($datas) || is_null($datas->id_tema))
    
  <div class="alert alert-warning" role="alert">
      Harap ajukan judul terlebih dahulu sebelum melanjutkan.
  </div>
  @else
  {{-- @if(is_null($datas) || is_null($datas->dosen_pembimbing_utama) || is_null($datas->dosen_pembimbing_ii))
    @if(is_null($datas) || is_null($datas->acc_dosen_utama) || is_null($datas->acc_dosen_ii))
    <div class="alert alert-warning" role="alert">
      Harap menyelesaikan bimbingan proposal dulu sampai diacc oleh dosen pembimbing utama dan ii.
    </div>
    @endif
    
  @elseif(is_null($datas) || is_null($datas->dosen_pembimbing_utama))
 
  @if(is_null($datas) || is_null($datas->acc_dosen_utama))
    
    <div class="alert alert-warning" role="alert">
        Harap menyelesaikan bimbingan proposal dulu sampai diacc oleh dosen pembimbing.
    </div>
    @endif --}}
   


    {{-- @if (is_null($datas) || is_null($datas->dosen_pembimbing_utama))
      @if(is_null($datas->acc_dosen_utama))
    <div class="alert alert-warning" role="alert">
        Harap menyelesaikan bimbingan proposal dulu sampai diacc oleh dosen pembimbing utama.
    </div>
      @elseif(!is_null($datas->acc_dosen_utama))
      <div class="alert alert-warning" role="alert">
        Harap.
    </div> --}}
    {{-- @endif --}}
      {{-- Pengecekan apakah dosen_pembimbing_utama tidak null dan dosen_pembimbing_ii null. Jika benar, pastikan acc_dosen_utama tidak null.
      Pengecekan apakah dosen_pembimbing_utama tidak null. Jika benar, periksa apakah acc_dosen_utama tidak null.
      Jika dosen_pembimbing_ii null (dan sebelumnya dicek bahwa dosen_pembimbing_utama tidak null), maka periksa apakah acc_dosen_utama tidak null dan acc_dosen_ii null, dan berikan peringatan yang sesuai. --}}
    {{-- @else --}}
    <div class="card mb-4">
        <h5 class="card-header">Daftar Seminar Proposal</h5>
        <div class="card-body">
          <form action="{{route('seminar-proposal.submit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">NPM</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  value="{{Auth::user()->kode_unik}}"
                  name="npm"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Nama Mahasiswa</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  {{-- value="Sony Adi Adriko"
                   --}}
                  name="nama"
                value="{{Auth::user()->name}}"

                  {{-- placeholder="Sony Adi Adriko" --}}
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
      
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 1</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  value="{{$datas->dosen_pembimbing_utama}}"
                  placeholder="Dosen Pembimbing 1"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 2</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Dosen Pembimbing 2"
                  value="{{$datas->dosen_pembimbing_ii}}"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            {{-- <input type="hidden" name="tema_id" value="{{ $datas->id_tema }}"> --}}
            <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">

            {{-- <input type="hidden" name="dosen_id" value="{{ $datas->id_dosen }}"> --}}
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File Proposal Skripsi</label>
                <input class="form-control" type="file" name="proposal_file" id="proposal_file" />
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File Slip Pembayaran Seminar Proposal</label>
                <input class="form-control" type="file" name="slip_file" id="slip_file" />
            </div>
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </form>
      </div>
    </div>
    @endif
</div>


@endsection