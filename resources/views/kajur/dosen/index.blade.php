@extends('layout.master3')

@section('title', 'Data Dosen')

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dosen</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="font-weight: bold">Data Dosen</h4>
                    <p class="card-title-desc">Data dosen yang aktif dapat dilihat pada tabel dibawah ini, dan juga terdapat
                        tombol detailnya.</p>
                </div>
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Bidang Ilmu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $groupedData = $datadsn->groupBy('name')->map(function ($item, $key) use (&$no) {
                                    return [
                                        'no' => $no++,
                                        'name' => $key,
                                        'kode_unik' => $item->first()->kode_unik,
                                        'topik_bidang_ilmu' => $item
                                            ->pluck('topik_bidang_ilmu')
                                            ->unique()
                                            ->implode(', '),
                                        'id' => $item->first()->id,
                                    ];
                                });
                            @endphp

                            @foreach ($groupedData as $data)
                                <tr>
                                    <td>{{ $data['no'] }}</td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['kode_unik'] }}</td>
                                    <td>{{ $data['topik_bidang_ilmu'] ?? 'Tidak ada' }}</td>
                                    <td><a href="{{ route('data-dsn-detail', ['id' => $data['id']]) }}"
                                            class="btn btn-primary">Detail</a></td>
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
