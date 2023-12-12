@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Pembagian Dosen Pembimbing</h5>
        <div class="card-body">
          <form action="{{route('pembagian-dosen.store')}}" method="POST">
            @csrf
            {{-- <div class="mb-3">
              <label for="id_pengajuan_judul" class="form-label">Id Pengajuan Judul</label>
              <select class="form-select" id="tema_id" name="tema_id" aria-label="Default select example">
                  @foreach($juduls as $jud)
                      <option value="{{ $jud->id_tema }}">{{ $jud->npm }}</option>
                  @endforeach
              </select>
          </div> --}}
          <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input
              class="form-control"
              type="text"
              id="npm"
              name="npm"
              value="{{$tema->npm}}"
              readonly
              autocomplete="npm"
            />
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <input type="hidden" name="users_id" id="users_id" value="{{ $tema->users_id }}">
          <input type="hidden" name="tema_id" id="tema_id" value="{{ $tema->id_tema }}">


          <div class="mb-3">
              <label for="dospem_1" class="form-label">Dosen Pembimbing 1</label>
              <select class="form-select" id="dospem_1" name="dospem_1" aria-label="Default select example">
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
          </div>

          <div class="mb-3">
              <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
              <select class="form-select" id="dospem_2" name="dospem_2" aria-label="Default select example">
                  <option value="tidak ada" selected>Tidak Ada</option>
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
              </select>
          </div>


        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary" name="action" value="sudah">Submit</button>
        </div>
          </form>
      </div>
    </div>
</div>


@endsection
