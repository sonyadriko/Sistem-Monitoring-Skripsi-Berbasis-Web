@extends('layout.master3')

@section('title')
Data Bidang Ilmu
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Bidang Ilmu</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Data Bidang Ilmu</h4>
                <p class="card-title-desc">Data bidang ilmu yang ada dapat dilihat pada tabel dibawah ini.</p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Topik Skripsi</th>
                        <th>Dosen Pengampu</th>
                        <th>Mata Kuliah Pendukung</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                    </thead>
                    <!-- Bagian Kode -->
<!-- Bagian Kode -->
<!-- Bagian Kode -->
<tbody>
    @php
    $no = 1;
    $groupedData = [];

    foreach ($databi as $data) {
        $topikBidangIlmu = $data->topik_bidang_ilmu;

        if (!array_key_exists($topikBidangIlmu, $groupedData)) {
            $groupedData[$topikBidangIlmu] = [
                'no' => $no++,
                'topik_bidang_ilmu' => $topikBidangIlmu,
                'name' => $data->name,
                'nama_mata_kuliah' => explode(',', $data->nama_mata_kuliah),
            ];
        } else {
            // Jika topik bidang ilmu sudah ada, tambahkan name dan mata_kuliah_pendukung ke array yang sudah ada
            $groupedData[$topikBidangIlmu]['name'] .= ', ' . $data->name;

            // Pecah string mata kuliah_pendukung menjadi array dan tambahkan ke array yang sudah ada
            $mataKuliahPendukung = explode(',', $data->nama_mata_kuliah);
            $groupedData[$topikBidangIlmu]['nama_mata_kuliah'] = array_merge(
                $groupedData[$topikBidangIlmu]['nama_mata_kuliah'],
                array_diff($mataKuliahPendukung, $groupedData[$topikBidangIlmu]['nama_mata_kuliah'])
            );
        }
    }
    @endphp

    @foreach($groupedData as $data)
        <tr>
            <td>{{ $data['no'] }}</td>
            <td>{{ $data['topik_bidang_ilmu'] }}</td>
            <td>{{ $data['name'] }}</td>
            <td>{{ implode(', ', $data['nama_mata_kuliah']) }}</td> <!-- Gabungkan array mata kuliah_pendukung menjadi string -->
        </tr>
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
