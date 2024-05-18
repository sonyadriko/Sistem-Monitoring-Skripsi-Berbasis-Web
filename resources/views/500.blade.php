@extends('layout.master2')

@section('content')
<!-- Konten utama halaman untuk error 500 -->
<div class="page-content d-flex align-items-center justify-content-center">

  <!-- Kontainer yang menampung semua elemen tampilan error -->
  <div class="row w-100 mx-0 auth-page">
    <!-- Kolom utama untuk konten error -->
    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
      <!-- Gambar ilustrasi error 500 -->
      <img src="{{ url('assets/images/others/500.svg') }}" class="img-fluid mb-2" alt="500">
      <!-- Judul besar dengan kode error -->
      <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">500</h1>
      <!-- Deskripsi singkat tentang jenis error -->
      <h4 class="mb-2">Kesalahan Server Internal</h4>
      <!-- Pesan tambahan untuk pengguna -->
      <h6 class="text-muted mb-3 text-center">Maaf, terjadi kesalahan. Silakan coba lagi nanti.</h6>
      <!-- Tombol untuk kembali ke halaman beranda -->
      <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
  </div>

</div>
@endsection