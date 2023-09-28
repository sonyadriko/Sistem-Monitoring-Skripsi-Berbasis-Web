@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Penjadwalan Seminar Proposal</h5>
        <div class="card-body">
            <form action="{{ route('koor-surat-tugas.update', ['id' => $data->id_surat_tugas]) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="bidang_ilmu" class="form-label">Judul yang diajukan</label>
                <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem_2" class="form-label">Tanggal Seminar Proposal</label>
                <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->tanggal}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
            <div class="mb-3">
              <label for="defaultFormControlInput" class="form-label">File Proposal</label>
              <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe>
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Slip Pembayaran Bimbingan</label>
                <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe>
              </div>
            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

<script>

</script>