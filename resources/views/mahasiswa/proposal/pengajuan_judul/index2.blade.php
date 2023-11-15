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
            <form action="{{route('pengajuan-judul.submit')}}" method="POST">
                @csrf
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
                {{-- placeholder="13.2019.1.00819" --}}
                readonly
                />
                @error('npm')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="bidang_ilmu" class="form-label">Bidang Keilmuan</label>
              <select class="form-select" id="bidang_ilmu" name="bidang_ilmu" aria-label="Default select example">
                <option value="" selected disabled="">Open this select menu</option>
                @foreach($bidang_ilmu as $bi)
                <option value="{{$bi->id_bidang_ilmu}}">{{$bi->topik_bidang_ilmu}}, {{$bi->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
      </div>
</div>
@endsection
