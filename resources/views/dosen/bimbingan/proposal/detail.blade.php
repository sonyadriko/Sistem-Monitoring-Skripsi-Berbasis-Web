@extends('layouts/template')

@section('title')
Bimbingan Proposal
@endsection

<link rel="stylesheet" href="{{asset('/css/custom.css')}}" />


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Form Bimbingan Proposal</h5>
        <div class="card-body">
           
                <p class="revisi-rumusan-masa">
                    <span class="span0-1">NPM :</span>
                    <span class="span1-1">13<br/></span>
                    <span class="span0-1">Nama :</span>
                    <span class="span1-1"><br/></span>
                    <span class="span0-1">Tema :</span>
                    <span class="span1-1"><br/></span>
                    <span class="span0-1">Dosen Pembimbing Utama :</span>
                    <span class="span1-1"><br/></span>
                    <span class="span0-1">Dosen Pembimbing II :</span>
                    <span class="span1-1"><br/></span>
                </p>
              


        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <div class="card mb-4 mb-xl-0">
                {{-- <h5 class="card-header">File Proposal</h5> --}}
                <div class="table-responsive">
                    <table class="table table-bordered id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Revisi Dosen</th>
                                <th>File</th>
                                <th>Validasi Revisi</th>
        
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            {{-- @foreach($surattugas as $st) --}}
                            <tr>
                                {{-- <td>{{ $st->id }}</td>
                                <td>{{ $st->name }}</td>
                                <td>{{ $st->kode_unik }}</td>
                                <td><a href="{{ url('/koordinator/jadwal_seminar_proposal/detail/' . $st->id) }}" class="btn btn-primary">Detail</a></td> --}}
                            </tr>
                            @php
                            $no++;
                            @endphp
                            {{-- @endforeach --}}
                            
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
        
    </div>
    {{-- <div class="col-xl-6 mb-3">
        <div class="card mb-4">
            <h5 class="card-header">Persetujuan Seminar</h5>
            <div class="card-body">
                <div class="mb-3">
                    <div class="col-md">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="manajemen_kualitas" name="mk_pilihan[]" id="defaultCheck5" />
                            <label class="form-check-label" for="defaultCheck5"> Dosen Pembimbing 1 </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck6" />
                            <label class="form-check-label" for="defaultCheck6"> Dosen Pembimbing 2 </label>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary" disabled>Daftar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="mb-3">
    {{-- <button type="submit" class="btn btn-primary">History Bimbingan</button> --}}
    </div>
    {{-- <button type="submit" class="btn btn-primary">Paper acuan / Referensi</button> --}}


</div>
@endsection