@extends('layouts/template')

@section('title')
Tambah Ruangan
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
  @endif
        <div class="card mb-4">
            <h5 class="card-header">Ruangan</h5>
            <div class="card-body">
              <form action="{{route('ruangan.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                    <input
                      type="text"
                      class="form-control"
                      id="namaRuangan"
                      name="namaRuangan"
                      placeholder="Masukan Nama Ruangan..."
                      aria-describedby="defaultFormControlHelp"
                    />
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
