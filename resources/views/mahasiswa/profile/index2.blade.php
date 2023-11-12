@extends('layouts/template')

@section('title')
Profile
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="card mb-4">
          <h5 class="card-header">Halaman Profile</h5>
          <div class="card-body">
            <!-- Isi dengan informasi profil yang ingin ditampilkan -->
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>NPM:</strong> {{ Auth::user()->kode_unik }}</p>
            <p><strong>Alamat Mahasiswa:</strong> {{ $details->alamat_mhs }}</p> 
            <p><strong>No Telp Mahasiswa:</strong> {{ $details->no_telp_mhs }}</p>
            <p><strong>Alamat Orang Tua:</strong> {{ $details->alamat_orang_tua }}</p>
            <p><strong>No Telp Orang Tua:</strong> {{ $details->no_telp_orang_tua }}</p> 

            <a href="{{ url('/profile/edit/' . Auth::user()->id) }}" class="btn btn-primary">Edit Profile</a>
            {{-- <td><a href="{{ url('/koordinator/pengajuan_judul/detail/' . $judul->id_tema) }}" class="btn btn-primary">Detail</a></td> --}}

        </div>
    </div>
</div>
@endsection