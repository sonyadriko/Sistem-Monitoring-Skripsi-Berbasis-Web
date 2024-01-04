@extends('layout.master3')

@section('title')
Yudisium
@endsection

@section('css')


<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
      <li class="breadcrumb-item active" aria-current="page">Status Kelulusan</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Status Kelulusan Mahasiswa</h4>
                <p class="card-title-desc">Tabel ini menampilkan list mahasiswa yang sudah daftar yudisium, dan juga terdapat tombol detail untuk menginputkan statusnya.
                </p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Bidang Ilmu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($yudisium as $yudisium)

                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $yudisium->name }}</td>
                            <td>{{ $yudisium->kode_unik }}</td>
                            <td>{{ $yudisium->topik_bidang_ilmu }}</td>
                            {{-- <td><button type="button" class="btn btn-primary status-button">Status</button></td> --}}

                            <td><a href="{{ url('/koordinator/yudisium/detail/' . $yudisium->id_yudisium) }}" class="btn btn-primary">Detail</a></td>
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

<!-- Modal for Status Update -->
{{-- <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Status Yudisium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="lulus">Lulus Tanpa Revisi</option>
                        <option value="lulus_revisi">Lulus dengan Revisi</option>
                        <option value="sidang_ulang">Sidang Ulang</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateStatus()">Update Status</button>
            </div>
        </div>
    </div>
</div> --}}



@endsection

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

    {{-- <script>
        $(document).ready(function () {
            var table = $('#datatable').DataTable();

            // Handle "Status" button click to open the modal
            $('#datatable tbody').on('click', '.status-button', function () {
                var data = table.row($(this).parents('tr')).data();
                // Open the modal
                $('#statusModal').modal('show');
            });

            // Add your logic for updating status here
            function updateStatus() {
                // Implement your logic to update the status based on the selected option
                // You may want to use AJAX to send the data to the server
            }
        });
    </script> --}}

@endsection

