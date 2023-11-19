@extends('layout.master3')

@section('title')
Berita Acara Sidang Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
      <li class="breadcrumb-item active" aria-current="page">BA Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Berita Acara Sidang Skripsi</h4>
                <p class="card-title-desc">DataTables has most features enabled by
                    default, so all you need to do to use it with your own tables is to call
                    the construction function: <code>$().DataTable();</code>.
                </p>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($baskripsi as $ba)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $ba->name }}</td>
                            <td>{{ $ba->kode_unik }}</td>
                            <td><a href="{{ url('/koordinator/berita_acara_skripsi/detail/' . $ba->id_berita_acara_s) }}" class="btn btn-primary">Detail</a></td>
                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
<script src="{{ asset('assets2/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets2/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets2/js/app.min.js') }}"></script>
@endsection
