@extends('layout.master')

@section('title', 'Daftar Sidang Skripsi')

@push('plugin-styles')
    <!-- Menghubungkan stylesheet untuk flatpickr dan jquery-steps -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <style>
        .wizard>.content {
            min-height: 50em;
            /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
        }
    </style>
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Navigasi breadcrumb untuk halaman sidang skripsi -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sidang Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <!-- Alert untuk mengingatkan mahasiswa menyelesaikan bimbingan skripsi -->
            <div class="alert alert-warning" role="alert">
                Harap menyelesaikan bimbingan skripsi sampai di acc oleh dosen pembimbing.
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{-- !-- row --> --}}
@endsection
@push('plugin-scripts')
    <!-- Menyertakan script untuk jquery-steps dan SweetAlert2 -->
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
@endpush
