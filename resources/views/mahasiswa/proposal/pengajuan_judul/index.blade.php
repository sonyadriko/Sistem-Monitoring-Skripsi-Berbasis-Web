@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Forms</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengajuan Tema</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Horizontal wizard</h4>
        <p class="text-muted mb-3">Read the <a href="http://www.jquery-steps.com/GettingStarted" target="_blank"> Official jQuery Steps Documentation </a>for a full list of instructions and other options.</p>
        <div id="wizard">
          <h2>Step Pertama</h2>
          <section>
            <p>Membaca urutan dari apa yang harus dilakukan dan dipersiapkan untuk melakukan pengajuan tema Proposal Skripsi terdapat pada gambar dibawah ini.</p>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas arcu sem, hendrerit a tempor quis, 
                sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc eget quam libero. Nam at felis metus. 
                Nam tellus dolor, tristique ac tempus nec, iaculis quis nisi.</p> --}}
          </section>

          <h2>Step Kedua</h2>
          <section>
            <p>Melakukan pengisian form dibawah ini.</p>
            <div class="card-body">
              <form action="{{route('pengajuan-judul.submit')}}" method="POST">
                  @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input class="form-control" type="text" id="name" name="nama" value="{{Auth::user()->name}}" readonly autocomplete="nama"/>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="npm" class="form-label">NPM Mahasiswa</label>
                <input class="form-control" type="text" id="npm" value="{{Auth::user()->kode_unik}}" name="npm" readonly/>
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
                  {{-- <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button> --}}
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </section>

          <h2>Step Ketiga</h2>
          <section>
            <p>Menunggu konfirmasi acc dan pembagian dosen dari koordinator</p>
            <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, 
                pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat. 
                Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris 
                venenatis.</p>
          </section>

          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/wizard.js') }}"></script>
@endpush