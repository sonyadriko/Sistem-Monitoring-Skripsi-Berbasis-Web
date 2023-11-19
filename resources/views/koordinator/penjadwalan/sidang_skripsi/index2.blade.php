@extends('layouts/template')

@section('title')
Pengajuan Sidang Skripsi
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
    <h5 class="card-header">Tabel Pengajuan Sidang Skripsi</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
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
                    @foreach($semhas as $semh)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $semh->name }}</td>
                        <td>{{ $semh->kode_unik }}</td>
                        <td><a href="{{ url('/koordinator/jadwal_sidang_skripsi/detail/' . $semh->id_sidang_skripsi) }}" class="btn btn-primary">Detail</a></td>
                    </tr>
                    @php
                    $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
  $('#dataTable').DataTable({
    paging: true,
    searching: true,
    ordering: true,
    // Opsi lainnya
  });
});
  </script>

