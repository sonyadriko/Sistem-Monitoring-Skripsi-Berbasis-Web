@extends('layout.master3')

@section('title', 'Tema Penelitian')

@section('css')
    <!-- Menghubungkan stylesheet untuk DataTables dan komponen-komponen terkait -->
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Breadcrumb untuk navigasi -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Bidang Ilmu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tema Penelitian</li>
        </ol>
    </nav>

    <!-- Kontainer utama untuk tabel tema penelitian -->
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="text-left">
                        <!-- Judul dan deskripsi halaman -->
                        <h5 class="card-title" style="font-weight: bold">Tabel List Tema Penelitian</h5>
                        <p class="card-title-desc">Berikut merupakan tabel list topik atau tema penelitian yang dapat
                            diambil oleh mahasiswa.</p>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <!-- Tabel yang menampilkan data tema penelitian -->
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tema Penelitian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bi as $index => $dosen)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dosen->topik_bidang_ilmu }}</td>
                                    <td><a href="{{ url('/dosen/bidang_ilmu/detail/' . $dosen->id_bidang_ilmu) }}" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <!-- Script untuk plugin yang digunakan pada halaman ini -->
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <!-- Script khusus untuk halaman dashboard -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
    <!-- Script untuk menginisialisasi DataTables dan fungsi-fungsi terkait -->
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
