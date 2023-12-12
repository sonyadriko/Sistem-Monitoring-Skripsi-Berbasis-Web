@extends('layout.master')

@section('title')
Edit Profile
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Edit Profile</h4>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          {{-- <h6 class="card-title">Data Mahasiswa</h6> --}}

          <form action="{{ route('update-profile.store', ['id' => Auth::user()->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">NPM</label>
              <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->kode_unik}}" autocomplete="off" placeholder="Username" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $data->name}}" placeholder="text" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat Mahasiswa</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value=" {{ $data->alamat_mhs }}" placeholder="alamat mahasiswa">
              </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">No Telp Mahasiswa</label>
              <input type="number" class="form-control" id="notelpmhs" name="notelpmhs" value="{{ $data->no_telp_mhs }}" placeholder="no telp mahasiswa">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Alamat Orang Tua</label>
              <input type="text" class="form-control" id="alamat_orang_tua" name="alamat_orang_tua" value="{{ $data->alamat_orang_tua }}" autocomplete="off" placeholder="alamat orang tua">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">No Telp Orang Tua</label>
                <input type="number" class="form-control" id="notelpot" name="notelpot" autocomplete="off" value="{{ $data->no_telp_orang_tua }}" placeholder="no telp orang tua">
              </div>
            {{-- <button type="submit" class="btn btn-primary me-2">Submit</button> --}}
            <button type="submit" class="btn btn-primary">Submit</button>

            {{-- <button class="btn btn-secondary">Cancel</button> --}}
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>

          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
