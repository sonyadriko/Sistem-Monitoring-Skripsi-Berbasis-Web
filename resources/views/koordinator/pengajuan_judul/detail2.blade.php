@extends('layouts.template')

@section('title', 'Proposal')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Form Pengajuan</h5>
        <div class="card-body">
            <form action="{{ route('update_status', ['id_tema' => $data->id_tema]) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input class="form-control" type="text" id="name" name="nama" value="{{ $data->name }}" readonly />
                </div>

                <div class="mb-3">
                    <label for="npm" class="form-label">NPM Mahasiswa</label>
                    <input class="form-control" type="text" id="npm" value="{{ $data->kode_unik }}" name="npm" placeholder="13.2019.1.00819" readonly />
                </div>

                <div class="mb-3">
                    <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data->topik_bidang_ilmu }}" name="tbi" readonly />
                </div>

                <div class="mb-3">
                    <label for="dosen_pembimbing_utama" class="form-label">Dosen Pembimbing Utama</label>
                    <input class="form-control" type="text" id="dosen_pembimbing_utama" value="{{ $data->nama_dosen }}" name="dosen_pembimbing_utama" readonly />
                </div>
                
                <div class="mb-3">
                    <label for="dosen_pembimbing_ii" class="form-label">Dosen Pembimbing II</label>
                    <select class="form-select" id="select1" name="dosen_pembimbing_ii" aria-label="Default select example">
                        <option value="" selected disabled>Open this select menu</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        @foreach($dosen2 as $datas)
                            @if($datas->name != $data->nama_dosen) <!-- Tambahkan kondisi untuk memeriksa kesamaan dengan Dosen Pembimbing Utama -->
                                <option value="{{ $datas->name }}">{{ $datas->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                

                <input type="hidden" name="tema_id" value="{{ $data->id_tema }}" />
                <input type="hidden" name="bidang_ilmu_id" value="{{ $data->bidang_ilmu_id }}" />
                <input type="hidden" name="user_id" value="{{ $data->user_id }}" />

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>

                    <div style="display: flex; justify-content: flex-end;">
                        @if ($data->status === 'pending')
                            <button type="submit" class="btn btn-primary" name="action" value="terima">Terima</button>
                            <button type="submit" class="btn btn-primary" name="action" value="tolak">Tolak</button>
                        @elseif ($data->status === 'terima')
                            <p>Data ini telah diterima.</p>
                        @elseif ($data->status === 'tolak')
                            <p>Data ini telah ditolak.</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
