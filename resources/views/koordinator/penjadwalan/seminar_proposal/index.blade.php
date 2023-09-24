@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
    <h5 class="card-header">Tabel Pengajuan Seminar Proposal</h5>
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
                    @foreach($sempros as $semp)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $semp->name }}</td>
                        <td>{{ $semp->kode_unik }}</td>
                        <td><a href="{{ url('/koordinator/jadwal_seminar_proposal/detail/' . $semp->id_seminar_proposal) }}" class="btn btn-primary">Detail</a></td>
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

