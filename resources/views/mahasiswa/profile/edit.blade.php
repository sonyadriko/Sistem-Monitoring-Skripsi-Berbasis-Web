@extends('layout.master')

@section('title', 'Edit Profile')

@section('content')
<!-- Bagian atas halaman yang menampilkan judul halaman -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <h4 class="mb-3 mb-md-0">Edit Profile</h4>
</div>

<!-- Bagian utama halaman yang menampilkan formulir untuk mengedit profil -->
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- Formulir untuk mengirim data profil yang telah diubah -->
                <form action="{{ route('update-profile.store', ['id' => Auth::user()->id]) }}" method="POST">
                    @csrf
                    <!-- Field NPM yang tidak dapat diubah -->
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control" id="npm" value="{{ Auth::user()->kode_unik}}" readonly>
                    </div>
                    <!-- Field Nama yang tidak dapat diubah -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" value="{{ $data->name}}" readonly>
                    </div>
                    <!-- Field untuk mengubah alamat mahasiswa -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Mahasiswa</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat_mhs }}">
                    </div>
                    <!-- Field untuk mengubah nomor telepon mahasiswa -->
                    <div class="mb-3">
                        <label for="notelpmhs" class="form-label">No Telp Mahasiswa</label>
                        <input type="number" class="form-control" id="notelpmhs" name="notelpmhs" value="{{ $data->no_telp_mhs }}">
                    </div>
                    <!-- Field untuk mengubah alamat orang tua -->
                    <div class="mb-3">
                        <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
                        <input type="text" class="form-control" id="alamat_orang_tua" name="alamat_orang_tua" value="{{ $data->alamat_orang_tua }}">
                    </div>
                    <!-- Field untuk mengubah nomor telepon orang tua -->
                    <div class="mb-3">
                        <label for="notelpot" class="form-label">No Telp Orang Tua</label>
                        <input type="number" class="form-control" id="notelpot" name="notelpot" value="{{ $data->no_telp_orang_tua }}">
                    </div>
                    <!-- Tombol untuk kembali ke halaman sebelumnya atau mengirimkan data -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
