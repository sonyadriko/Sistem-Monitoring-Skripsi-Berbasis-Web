@extends('layouts/template')

@section('title')
Dashboard - Koordinator
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <p>Selamat datang koordinator skripsi </p>
    <p>silahkan memilih tombol dibawah ini untuk masuk ke halaman yang diinginkan</p>
    <p>Jumlah Mahasiswa : {{$mahasiswaCount }}</p>
    <p>Jumlah Dosen : {{$dosenCount}}</p>

</div>
@endsection