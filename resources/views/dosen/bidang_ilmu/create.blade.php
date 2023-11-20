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
      <li class="breadcrumb-item active" aria-current="page">Topik</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
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
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
