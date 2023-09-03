@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-3">
        <h5 class="card-header">Berita Acara Seminar Proposal</h5>
        {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
        <div class="card-body">
            <div class="card-datatable table-responsive  pt-0">
            <table class="table table-borderless"/>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>NPM</td>
                        <td>13.2019.1.00819</td>
                        <td>No Ujian</td>
                        <td>xx.xxx.xx</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>Sony Adi Adriko</td>
                        <td>Hari Tanggal</td>
                        <td>Senin, 7 Agustus 2023</td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>Rancang bangun aplikasi monitoring skripsi</td>
                        <td>Ruang, Waktu</td>
                        <td>A-204, 09:00 - Selesai</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 1</td>
                        <td>Dosen Pembimbing 1</td>
                        <td>Dosen Pembimbing 2</td>
                        <td>Dosen Pembimbing 2</td>
                    </tr>
                    <tr>
                        <td>Dosen Penguji</td>
                        <td>Dosen Pembimbing 1<br>
                            Dosen Pembimbing 1<br>
                            Dosen Pembimbing 1
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Review Dosen Pembimbing</h5>
        {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
        <div class="card-body">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Revisi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan keterangan singkat mengenai tema/judul penelitian"></textarea>
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Nilai Ujian</label>
                <input
                  type="number"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Masukan Bidang Ilmu..."
                  aria-describedby="defaultFormControlHelp"
                />
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection