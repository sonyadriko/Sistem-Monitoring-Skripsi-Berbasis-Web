@extends('layout.master')

@section('title', 'History Revisi Sidang Proposal')

@section('content')
    {{-- // Menampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- // Bagian header halaman history revisi sidang proposal --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0">History Revisi Sidang Proposal</h4>
    </div>

    <h6 class="mb-4">Seluruh informasi mengenai history revisi sidang proposal akan ditampilkan dibawah ini.</h6>

    {{-- // Bagian utama halaman yang menampilkan tabel history revisi --}}
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bimbingan</th>
                                    <th>Tanggal</th>
                                    <th>Revisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($historyBimbMhs as $index => $hbmhs)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($hbmhs->created_at)->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $hbmhs->revisi }} dari {{ $hbmhs->nama_penguji_1 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data revisi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- // Bagian yang menampilkan data mahasiswa dan dosen pembimbing --}}
            <div class="card mb-4">
                <h5 class="card-header">Data Mahasiswa dan Dosen Pembimbing</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                @foreach ($hisbimdet as $hbmhs)
                                    <tr>
                                        <td>NPM</td>
                                        <td>{{ $hbmhs->kode_unik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $hbmhs->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>{{ $hbmhs->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bidang Ilmu</td>
                                        <td>{{ $hbmhs->topik_bidang_ilmu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dosen Pembimbing Utama</td>
                                        <td>{{ $hbmhs->dosen_pembimbing_utama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dosen Pembimbing II</td>
                                        <td>{{ $hbmhs->dosen_pembimbing_ii }}</td>
                                    </tr>
                                @break
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
