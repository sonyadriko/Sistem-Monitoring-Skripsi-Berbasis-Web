@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Penjadwalan Seminar Proposal</h5>
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
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 1</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Dosen Pembimbing 1"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 2</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Dosen Pembimbing 2"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Ketua Seminar</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="col-md">
                    <small class="text-bold fw-semibold">Dosen Penguji</small>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                      <label class="form-check-label" for="defaultCheck1"> Audit SI-TI </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                      <label class="form-check-label" for="defaultCheck2"> Recommender System </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                      <label class="form-check-label" for="defaultCheck3"> Business Inteligence </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck3"> Perencanaan Strategis SI/TI </label>
                      </div>
                  </div>
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Ruangan Seminar</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="A-204"
                  aria-describedby="defaultFormControlHelp"
                />
            </div>
            <div class="mb-3">
                <label for="html5-datetime-local-input" class="form-label">Datetime</label>
                
                  <input
                    class="form-control"
                    type="datetime-local"
                    value="2021-06-18T12:30:00"
                    id="html5-datetime-local-input"
                  />
              </div>
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </div>
    </div>
</div>


@endsection