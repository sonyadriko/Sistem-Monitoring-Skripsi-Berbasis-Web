@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Table Daftar Mahasiswa Revisi Seminar Proposal</h5>

    <div class="card-body">
      <div class=" table-responsive  pt-0">
        <table class="table"/>
        {{-- <div class="table-responsive"> --}}
            {{-- <table class="table table-bordered id="dataTable" width="100%" cellspacing="0"> --}}
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Action</th>
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach($rev as $dosen)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $dosen->name }}</td>
                        <td>{{ $dosen->topik_bidang_ilmu }}</td>
                        <td><a href="{{ url('/dosen/revisi_seminar_proposal/detail/' . $dosen->id_revisi_seminar_proposal) }}" class="btn btn-primary">Cek Revisi</a></td>
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
