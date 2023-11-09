@extends('layouts/template')

@section('title')
Surat Tugas
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(
        optional($datas)->alamat_mhs === null ||
        optional($datas)->no_telp_mhs === null ||
        optional($datas)->alamat_orang_tua === null ||
        optional($datas)->no_telp_orang_tua === null
    )
        <div class="alert alert-warning" role="alert">
            Harap Melengkapi Profile
        </div>
    @elseif(optional($datas)->users_id === null)
        <div class="alert alert-warning" role="alert">
            Harap Mengajukan Judul
        </div>

    @else
        <div class="card mb-4">
          <h5 class="card-header">Form Pengajuan Surat Tugas</h5>
          <div class="card-body">
            <form action="{{route('pengajuan-st.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
               <div class="mb-3">
                <label for="judulskripsi" class="form-label">Judul Skripsi</label>
                <input
                  class="form-control"
                  type="text"
                  id="judulskripsi"
                  value="{{$datas->topik_bidang_ilmu}}"
                  name="judulskripsi"
                  placeholder="Masukan Dosen Pembimbing 1..."
                  readonly
                  />
                  @error('judulskripsi')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                <input
                  class="form-control"
                  type="text"
                  id="dospem1"
                  name="dospem1"
                  value="{{$datas->dosen_pembimbing_utama}}"
                  readonly
                  placeholder="Masukan Dosen Pembimbing 1..."
                  />
                  @error('dospem1')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                <input
                  class="form-control"
                  type="text"
                  id="dospem2"
                  name="dospem2"
                  value="{{$datas->dosen_pembimbing_ii}}"
                  readonly
                  placeholder="Masukan Dosen Pembimbing 2..."
                  />
                  @error('dospem2')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
               <div class="mb-3">
              <label for="name" class="form-label">Nama Mahasiswa</label>
              <input
                class="form-control"
                type="text"
                id="name"
                name="nama"
                value="{{Auth::user()->name}}"
                readonly
                autocomplete="nama"
              />
              @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="npm" class="form-label">NPM Mahasiswa</label>
              <input
                class="form-control"
                type="text"
                id="npm"
                value="{{Auth::user()->kode_unik}}"
                name="npm"
                readonly
                />
                @error('npm')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
              <div class="mb-3">
                <label for="html5-tanggal_sidang_proposal-input" class="form-label">Tanggal Sidang Proposal Skripsi</label>
                <input class="form-control" type="date" name="tanggal_sidang_proposal" id="tanggal_sidang_proposal" />
              </div>
              <div class="mb-3">
                <label for="file_proposal" class="form-label">Upload File Proposal Skripsi</label>
                <input class="form-control" type="file" name="file_proposal" id="file_proposal" />
            </div>
            <div class="mb-3">
                <label for="file_slip_pembayaran" class="form-label">Upload File Slip Pembayaran Surat Tugas</label>
                <input class="form-control" type="file" name="file_slip_pembayaran" id="file_slip_pembayaran" />
            </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="bimbingan_proposal_id" value="{{$datas->id_bimbingan_proposal}}">
            {{-- <input type="hidden" name="tema_id" value="{{ $datas->id_tema }}"> --}}
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
