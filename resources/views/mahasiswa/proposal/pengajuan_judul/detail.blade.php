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
                value="sony adi adriko"
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
                value="13.2019.1.00819"
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
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
                <div class="col-md">
                    <small class="text-bold fw-semibold">Mata Kuliah Pilihan Semester VII</small>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="audit_siti" name="mk_pilihan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1"> Audit SI-TI </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="recommender_system" name="mk_pilihan[]" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2"> Recommender System </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="business_intelligence" name="mk_pilihan[]" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3"> Business Intelligence </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="perencanaan_strategis" name="mk_pilihan[]" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4"> Perencanaan Strategis SI/TI </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-md">
                    <small class="text-bold fw-semibold">Mata Kuliah Pilihan Semester VIII</small>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="manajemen_kualitas" name="mk_pilihan[]" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5"> Manajemen Kualitas SI/TI </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck6" />
                        <label class="form-check-label" for="defaultCheck6"> Model dan Simulasi Sistem </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="rekayasa_kebutuhan" name="mk_pilihan[]" id="defaultCheck7" />
                        <label class="form-check-label" for="defaultCheck7"> Rekayasa Kebutuhan </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="sistem_informasi_intelegensia" name="mk_pilihan[]" id="defaultCheck8" />
                        <label class="form-check-label" for="defaultCheck8"> Sistem Informasi Intelegensia </label>
                    </div>
                </div>
            </div>
            <div>
                <label for="exampleFormControlTextarea1" class="form-label">Rencana Judul Proposal</label>
                <textarea class="form-control @error('judul') is-invalid @enderror" id="exampleFormControlTextarea1" name="judul" rows="3"></textarea>
                @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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