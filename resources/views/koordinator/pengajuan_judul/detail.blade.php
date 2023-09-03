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
                    <label for="name" class="form-label">Id</label>
                    <input
                      class="form-control"
                      type="text"
                      id="name"
                      name="nama"
                      value="{{$data->id_tema}}"
                      placeholder="Sony Adi Adriko"
                      readonly
                      autocomplete="nama"
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
              <label for="bidang_ilmu" class="form-label">Bidang Keilmuan</label>
              <select class="form-select" id="bidang_ilmu" name="bidang_ilmu" aria-label="Default select example">
                @foreach($bidang_ilmu as $bi)
                    <option value="{{$data->bidang_ilmu_id}}" 
                    @if ($data->bidang_ilmu_id == $bi->id)
                    selected
                    @endif>{{$bi->topik_bidang_ilmu}}</option>
                @endforeach
                    
              </select>
            </div>
            <div class="mb-3">
                <div class="col-md">
                    <small class="text-bold fw-semibold">Mata Kuliah Pilihan</small>
                    <textarea class="form-control" id="mk_pilihan" name="keterangan" rows="3" placeholder="Masukan keterangan singkat mengenai tema/judul penelitian">{{$data->mk_pilihan}}</textarea>
                    
                </div>
            </div>
            <div>
                <label for="exampleFormControlTextarea1" class="form-label">Rencana Judul Proposal</label>
                <textarea class="form-control @error('judul') is-invalid @enderror" id="exampleFormControlTextarea1"  name="judul" rows="3">{{$data->judul}}</textarea>
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                <form action="{{ route('update_status', ['id_tema' => $data->id_tema]) }}" method="POST">
                    @csrf
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
            
                </form>
                
            </div>
            {{-- </form> --}}
          </div>
      </div>
</div>
@endsection