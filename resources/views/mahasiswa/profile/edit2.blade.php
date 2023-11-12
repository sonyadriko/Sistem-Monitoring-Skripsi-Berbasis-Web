@extends('layouts/template')

@section('title')
Edit Profile
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="card mb-4">
          <h5 class="card-header">Form Pengajuan</h5>
          <div class="card-body">
            <form action="{{ route('update-profile.store', ['id' => Auth::user()->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input
                      class="form-control"
                      type="text"
                      id="name"
                      name="nama"
                      value="{{Auth::user()->name}}"
                      readonly
                    />
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
            <div class="mb-3">
              <label for="npm" class="form-label">NPM</label>
              <input
                class="form-control"
                type="text"
                id="npm"
                name="npm"
                value="{{Auth::user()->kode_unik}}"
                readonly
              />
              @error('npm')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Mahasiswa</label>
                <input
                  class="form-control"
                  type="text"
                  id="alamat"
                  name="alamat"
                  value="{{$data->alamat_mhs}}"
                  placeholder="Masukan Alamat..."
                  />
                  @error('alamat')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="notelpmhs" class="form-label">No Telp Mahasiswa</label>
                <input
                  class="form-control"
                  type="number"
                  id="notelpmhs"
                  value="{{$data->no_telp_mhs}}"

                  name="notelpmhs"
                  placeholder="Masukan No Telp Mahasiswa..."
                  />
                  @error('notelpmhs')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua Mahasiswa</label>
                <input
                  class="form-control"
                  type="text"
                  value="{{$data->alamat_orang_tua}}"

                  id="alamat_orang_tua"
                  name="alamat_orang_tua"
                  placeholder="Masukan Alamat Orang Tua..."
                  />
                  @error('alamat_orang_tua')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="notelpot" class="form-label">No Telp Orang Tua</label>
                <input
                  class="form-control"
                  type="number"
                  id="notelpot"
                  value="{{$data->no_telp_orang_tua}}"

                  name="notelpot"
                  placeholder="Masukan No Telp Orang Tua..."
                  />
                  @error('notelpot')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              
                <div style="display: flex; justify-content: flex-end;">
                    
                    <!-- Tombol "Terima" dan "Tolak" hanya ditampilkan jika status adalah "pending" -->
                    <button type="submit" class="btn btn-primary">Submit</button>
               
            </div>
        
            <!-- Tampilkan pesan jika status adalah "diterima" -->
            
                
            </div>
        </form>
          </div>
      </div>
</div>
@endsection