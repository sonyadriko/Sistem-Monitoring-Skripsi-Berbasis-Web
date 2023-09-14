@extends('layouts/template')

@section('title')
Proposal
@endsection

<!-- Link ke CSS DataTables -->
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css"> --}}


{{-- <!-- Link ke JavaScript DataTables (termasuk jQuery) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script> --}}


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Table Bidang Ilmu</h5>
    <div class="card-body">
      <a href="{{ url('/dosen/bidang_ilmu/create') }}" class="btn btn-success mb-3">Tambah Data</a>
      <div class=" table-responsive  pt-0">
        <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tema</th>
                        <th>Keterangan</th>
                        {{-- <th>Action</th> --}}
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach($bi as $dosen)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $dosen->topik_bidang_ilmu }}</td>
                        <td>{{ $dosen->keterangan }}</td>
                        {{-- <td><a href="{{ url('/koordinator/bimbingan_proposal/detail/' . $dosen->id_bidang_ilmu) }}" class="btn btn-primary">Detail</a></td> --}}
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

