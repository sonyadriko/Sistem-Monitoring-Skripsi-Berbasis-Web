@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Pembagian Dosen Pembimbing</h5>
        <div class="card-body">
            {{-- <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">No Bimbingan</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="xx.xxx.xxx"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div> --}}
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">NPM</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="13.2019.1.00819"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Nama Mahasiswa</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Sony Adi Adriko"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Judul yang diajukan</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Sistem pendukung keputusan "
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Mata Kuliah Pilihan (Semester genap&ganjil)</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Audit SI/TI" readonly></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Dosen Pembimbing 1</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Dosen Pembimbing 2</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
            </div>
       
      
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </div>
    </div>
</div>


@endsection