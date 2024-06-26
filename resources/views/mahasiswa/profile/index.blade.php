@extends('layout.master')

@section('title', 'Profile')

@section('content')
    <!-- Bagian atas halaman yang menampilkan pesan sukses dan judul halaman -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        @if (session('success'))
            <!-- Alert untuk menampilkan pesan sukses -->
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h4 class="mb-3 mb-md-0">Profile</h4>
    </div>
    <h6 class="mb-4">Data diri Anda dapat dilihat dan diedit pada halaman ini.</h6>

    <!-- Bagian utama halaman yang menampilkan data mahasiswa -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Mahasiswa</h6>
                    <!-- Formulir yang menampilkan data mahasiswa yang tidak dapat diubah -->
                    <form class="forms-sample">
                        <div class="mb-3">
                            <label for="viewKodeUnik" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="viewKodeUnik"
                                value="{{ Auth::user()->kode_unik }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="viewName" value="{{ Auth::user()->name }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewAlamatMahasiswa" class="form-label">Alamat Mahasiswa</label>
                            <input type="text" class="form-control" id="viewAlamatMahasiswa"
                                value="{{ $details->alamat_mhs ?? 'Belum Diisi' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewNoTelpMahasiswa" class="form-label">No Telp Mahasiswa</label>
                            <input type="text" class="form-control" id="viewNoTelpMahasiswa"
                                value="{{ $details->no_telp_mhs ?? 'Belum Diisi' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewAlamatOrangTua" class="form-label">Alamat Orang Tua</label>
                            <input type="text" class="form-control" id="viewAlamatOrangTua"
                                value="{{ $details->alamat_orang_tua ?? 'Belum Diisi' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="viewNoTelpOrangTua" class="form-label">No Telp Orang Tua</label>
                            <input type="text" class="form-control" id="viewNoTelpOrangTua"
                                value="{{ $details->no_telp_orang_tua ?? 'Belum Diisi' }}" disabled>
                        </div>
                    </form>
                    <!-- Tombol untuk mengarahkan pengguna ke halaman edit profil -->
                    <div class="mt-4">
                        <a href="{{ url('/profile/edit/' . Auth::user()->id) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
