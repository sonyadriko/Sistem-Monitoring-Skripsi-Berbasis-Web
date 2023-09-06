@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Tabel Pengajuan Surat Tugas</h5>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        {{-- <th>File Proposal</th>
                        <th>Slip Pembayaran</th> --}}
                        <th>Action</th>

                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach($surattugas as $st)
                    <tr>
                        <td>{{ $st->id }}</td>
                        <td>{{ $st->name }}</td>
                        <td>{{ $st->kode_unik }}</td>
                        {{-- <td>{{ $semp->file_proposal }}</td>
                        <td>{{ $semp->file_slip_pembayaran }}</td> --}}
                        <td><a href="{{ url('/koordinator/jadwal_seminar_proposal/detail/' . $st->id) }}" class="btn btn-primary">Detail</a></td>
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

