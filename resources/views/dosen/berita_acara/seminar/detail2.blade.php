@extends('layouts/template')

@section('title')
Berita Acara Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-3">
        <h5 class="card-header">Berita Acara Seminar Proposal</h5>
        {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
        <div class="card-body">
            <div class="card-datatable table-responsive  pt-0">
            <table class="table table-borderless datatables-basicd border-top"/>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>NPM</td>
                        <td>{{$data->kode_unik}}</td>
                        <td>Hari Tanggal</td>
                        <td>Senin, 7 Agustus 2023</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>{{$data->name}}</td>
                        @php
                        $dateFromDatabase = $data->tanggal;
                        $formattedDate = date('d F Y', strtotime($dateFromDatabase));
                        // echo $formattedDate; // Hasil: 28 Juni 2021
                        
                        @endphp
                        <td>Hari Tanggal</td>
                        <td>{{$formattedDate}}</td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>{{$data->topik_bidang_ilmu}}</td>
                        <td>Ruang, Waktu</td>
                        <td>{{$data->ruangan}}, {{$data->jam}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 1</td>
                        <td>{{$data->dosen_pembimbing_utama}}</td>
                        <td>Dosen Pembimbing 2</td>
                        <td>{{$data->dosen_pembimbing_ii}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Penguji</td>
                        <td>{{$data->nama_penguji_1}}<br/>
                            {{$data->nama_penguji_2}}
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Review Dosen Pembimbing</h5>
        <form action="{{route('berita-acara-proposal.store')}}" method="POST">
            @csrf
        {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
        <div class="card-body">
            <div class="mb-3">
                <label for="revisi" class="form-label">Revisi</label>
                <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
            </div>
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai Ujian</label>
                <input
                  type="number"
                  class="form-control"
                  name="nilai"
                  id="nilai"
                  placeholder="Masukan Nilai Ujian..."
                  aria-describedby="defaultFormControlHelp"
                />
            </div>
            <input type="hidden" name="berita_acara_proposal_id" value="{{$data->id_berita_acara_p}}"/>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection