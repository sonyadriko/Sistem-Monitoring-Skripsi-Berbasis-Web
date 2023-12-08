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
            <h5 class="card-header">Bidang Ilmu</h5>
            <div class="card-body">
              <form action="{{route('bidang-ilmu.submit')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Topik Bidang Ilmu</label>
                    <input
                      type="text"
                      class="form-control"
                      id="defaultFormControlInput"
                      name="topik_bidang_ilmu"
                      placeholder="Masukan Bidang Ilmu..."
                      aria-describedby="defaultFormControlHelp"
                    />
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Matakuliah Pendukung</label>
                    <input
                      type="text"
                      class="form-control"
                      id="defaultFormControlInput"
                      placeholder="Masukan Matakuliah Pendukung..."
                      name="mata_kuliah_pendukung"
                      aria-describedby="defaultFormControlHelp"
                    />
                </div>
           
            <div>
              <label for="exampleFormControlTextarea1" class="form-label">Keterangan Singkat</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3" placeholder="Masukan keterangan singkat mengenai tema/judul penelitian"></textarea>
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