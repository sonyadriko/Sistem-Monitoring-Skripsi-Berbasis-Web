@extends('layouts/template')

@section('title')
Berita Acara Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
    <h5 class="card-header">Tabel Seminar Proposal</h5>
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
                    @foreach($ba as $ba)
                    <tr>
                        <td>{{ $ba->id_berita_acara_p }}</td>
                        <td>{{ $ba->name }}</td>
                        <td>{{ $ba->kode_unik }}</td>
                        <td><a href="{{ url('/dosen/berita_acara_proposal/detail/'.$ba->id_berita_acara_p) }}" class="btn btn-primary">Detail</a></td>
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
