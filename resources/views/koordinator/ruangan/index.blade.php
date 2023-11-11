@extends('layouts/template')

@section('title')
Ruangan
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Table Ruangan</h5>
    <div class="card-body">
      <a href="{{ url('/koordinator/ruangan/create') }}" class="btn btn-success mb-3">Tambah Data</a>
      <div class=" table-responsive  pt-0">
        <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Action</th>
                        {{-- <th>Action</th> --}}
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach($ruangan as $ruangan)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $ruangan->nama_ruangan }}</td>
                        {{-- <td>{{ $dosen->keterangan }}</td> --}}
                        <td><a href="{{ url('/koordinator/ruangan/edit/' . $ruangan->id_ruangan) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ url('/koordinator/ruangan/delete/' . $ruangan->id_ruangan) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">Delete</button>
                            </form>
                        </td>
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

