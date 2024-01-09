@extends('layout.master')

@section('title')
Tambah Topik
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Bidang Ilmu</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tema Penelitian</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card mb-4">
            <h5 class="card-header">Bidang Ilmu</h5>
            <div class="card-body">
                <form action="{{route('bidang-ilmu.submit')}}" method="POST"enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="topik_bidang_ilmu" class="form-label">Topik Bidang Ilmu</label>
                            <input type="text" class="form-control" id="topik_bidang_ilmu" name="topik_bidang_ilmu" placeholder="Masukan Bidang Ilmu..." aria-describedby="defaultFormControlHelp" />
                        </div>
                    </div>
                    <label class="form-label">Matakuliah Pendukung</label>
                    <div class="mb-3" style="max-height: 200px; overflow-y: auto;">
                        @foreach ($mkp as $mkp)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $mkp->id_mata_kuliah_pendukung }}" name="selected_mkp[]" id="mkp_{{ $mkp->id_mata_kuliah_pendukung }}">
                                <label class="form-check-label" for="mkp_{{ $mkp->id_mata_kuliah_pendukung }}">{{ $mkp->nama_mata_kuliah }}</label>
                            </div>
                        @endforeach

                        @error('selected_mkp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <label class="form-label">Dosen Pengampu</label>
                    <div class="mb-3" style="max-height: 200px; overflow-y: auto;">
                        @foreach ($users as $user)
                            @if ($user->role_id == 2)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $user->id }}" name="selected_users[]" id="user_{{ $user->id }}">
                                    <label class="form-check-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                </div>
                            @endif
                        @endforeach

                        @error('selected_users')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Singkat</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukan keterangan singkat mengenai bidang ilmu penelitian"></textarea>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="mb-3">
                            <label for="file_proposal" class="form-label">Upload File Paper Acuan Referensi</label>
                            <input class="form-control" type="file" id="paper" name="paper[]" multiple />
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
