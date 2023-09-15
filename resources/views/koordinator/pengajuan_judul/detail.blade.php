@extends('layouts/template')

@section('title')
Proposal
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
            {{-- <form action="{{route('pengajuan-judul.submit')}}" method="POST">
                @csrf --}}
                <div class="mb-3">
                    <label for="id" class="form-label">Id</label>
                    <input
                      class="form-control"
                      type="text"
                      id="id"
                      name="id"
                      value="{{$data->id_tema}}"
                      readonly
                    />
                    @error('nama')
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
                value="{{$data->nama}}"
                placeholder="Sony Adi Adriko"
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
                value="{{$data->npm}}"

                name="npm"
                placeholder="13.2019.1.00819"
                readonly
                />
                @error('npm')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
              <input
                class="form-control"
                type="text"
                id="tbi"
                value="{{$data->topik_bidang_ilmu}}"
                name="tbi"
                readonly
                />
                @error('tbi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <form action="{{ route('update_status', ['id_tema' => $data->id_tema]) }}" method="POST">
              @csrf
            <div class="mb-3">
              <label for="dosen_pembimbing_utama" class="form-label">Dosen</label>
              <input
                class="form-control"
                type="text"
                id="dosen_pembimbing_utama"
                value="{{$data->dosen}}"
                name="dosen_pembimbing_utama"
                readonly
                />
                @error('dosen_pembimbing_utama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="tema_id" value="{{$data->id_tema}}"/>
            <input type="hidden" name="user_id" value="{{$data->user_id}}"/>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                
                <div style="display: flex; justify-content: flex-end;">
                    @if ($data->status === 'pending')
                    <!-- Tombol "Terima" dan "Tolak" hanya ditampilkan jika status adalah "pending" -->
                    <button type="submit" class="btn btn-primary" name="action" value="terima">Terima</button>
                    <button type="submit" class="btn btn-primary" name="action" value="tolak">Tolak</button>
                @elseif ($data->status === 'terima')
                    <p>Data ini telah diterima.</p>
                @elseif ($data->status === 'tolak')
                    <p>Data ini telah ditolak.</p>
                @endif
            </div>
        
            <!-- Tampilkan pesan jika status adalah "diterima" -->
            
                
                
            </div>
          </form>
            {{-- </form> --}}
          </div>
      </div>
</div>
@endsection