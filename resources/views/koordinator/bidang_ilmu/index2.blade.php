@extends('layouts/template')

@section('title')
Bidang Ilmu
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Table Bidang Ilmu</h5>
    <div class="card-body">
      <a href="{{ url('/dosen/bidang_ilmu/create') }}" class="btn btn-primary mb-3">Tambah Data</a>
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

