@extends('layouts/template')

@section('title')
Berita Acara Skripsi
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
                    @foreach($baskripsi as $ba)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $ba->name }}</td>
                        <td>{{ $ba->kode_unik }}</td>
                        <td><a href="{{ url('/koordinator/berita_acara_skripsi/detail/' . $ba->id_berita_acara_s) }}" class="btn btn-primary">Detail</a></td>
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
