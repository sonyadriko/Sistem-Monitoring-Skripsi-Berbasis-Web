@extends('layouts/template')

@section('title')
Detail Pembagian Dosen
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="card mb-4">
          <h5 class="card-header">Halaman Pembagian Dosen</h5>
          <div class="card-body">
            <!-- Isi dengan informasi profil yang ingin ditampilkan -->
            <p><strong>Nama : </strong> {{ $users->name }}</p>
            <p><strong>NPM : </strong> {{ $users->kode_unik }}</p>
            <p><strong>Judul : </strong> {{ $tema->judul }}</p>
            {{-- <p><strong>Bidang Ilmu : </strong> {{ $details->alamat_orang_tua }}</p> --}}
            <p><strong>Dospem 1 : </strong> {{ $details->alamat_mhs }}</p> 
            <p><strong>Dospem 2 :</strong> {{ $details->no_telp_mhs }}</p>

            {{-- <a href="{{ url('/profile/edit/' . Auth::user()->id) }}" class="btn btn-primary">Edit Profile</a> --}}
            {{-- <td><a href="{{ url('/koordinator/pengajuan_judul/detail/' . $judul->id_tema) }}" class="btn btn-primary">Detail</a></td> --}}

        </div>
    </div>
</div>
@endsection