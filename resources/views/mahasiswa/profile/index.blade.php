@extends('layout.master')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div>
      <h4 class="mb-3 mb-md-0">Profile</h4>
    </div>
  </div>
  <h6 class="mb-4">Data diri anda dapat dilihat pada halaman ini, anda dapat melakukan pengeditan informasi dibawah ini.</h6>

  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Data Mahasiswa</h6>

          <form class="forms-sample">
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">NPM</label>
              <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->kode_unik }}" autocomplete="off" placeholder="Username" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ Auth::user()->name }}" placeholder="Nama" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat Mahasiswa</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $details->alamat_mhs }}" placeholder="Alamat" disabled>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">No Telp Mahasiswa</label>
              <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $details->no_telp_mhs }}" placeholder="No Telp" disabled>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Alamat Orang Tua</label>
              <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $details->alamat_orang_tua }}" autocomplete="off" placeholder="Alamat Orang Tua" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">No Telp Orang Tua</label>
                <input type="text" class="form-control" id="exampleInputPassword1" autocomplete="off" value="{{ $details->no_telp_orang_tua }}" placeholder="No Telp Orang Tua" disabled>
            </div>
          </form>
          <div class="mt-4">
            <a href="{{ url('/profile/edit/' . Auth::user()->id) }}" class="btn btn-primary">Edit Profile</a>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection
