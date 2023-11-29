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
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Matakuliah Pendukung</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline1" value="Keamanan SI - TI">
                                    <label class="form-check-label" for="checkInline1">
                                        Keamanan SI - TI
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline2" value="Rekayasa Perangkat Lunak">
                                    <label class="form-check-label" for="checkInline2">
                                        Rekayasa Perangkat Lunak
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline3" value="E-Business">
                                    <label class="form-check-label" for="checkInline3">
                                        E-Business
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline4" value="Data Mining">
                                    <label class="form-check-label" for="checkInline4">
                                        Data Mining
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline5" value="Interaksi Manusia dan Komputer">
                                    <label class="form-check-label" for="checkInline5">
                                        Interaksi Manusia dan Komputer
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline6" value="Sistem Pendukung Keputusan">
                                    <label class="form-check-label" for="checkInline6">
                                        Sistem Pendukung Keputusan
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="matkulpen[]" class="form-check-input" id="checkInline7" value="Sistem Peramalan">
                                    <label class="form-check-label" for="checkInline7">
                                        Sistem Peramalan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="sub_bidang_ilmu" class="form-label">Sub Bidang Ilmu</label>
                            <input type="text" class="form-control" id="sub_bidang_ilmu" placeholder="Masukan sub bidang ilmu..." name="sub_bidang_ilmu" aria-describedby="defaultFormControlHelp" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Singkat</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukan keterangan singkat mengenai tema/judul penelitian"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="file_proposal" class="form-label">Upload File Paper Acuan Referensi</label>
                            <input class="form-control" type="file" id="paper" name="paper[]" multiple />
                        </div>
                    </div>
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
