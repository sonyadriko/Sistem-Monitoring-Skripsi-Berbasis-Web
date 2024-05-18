@extends('layout.master')

@push('plugin-styles')
    <!-- Menambahkan stylesheet untuk plugin flatpickr -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
    <!-- Judul halaman -->
    Dashboard
@endsection

@section('content')
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Layout utama untuk konten halaman -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    </div>
    <!-- Judul sub halaman -->
    <h6 class="mb-4" style="font-size: 24px">Anda login sebagai <b>Dosen Pembimbing</b></h6>

    <!-- Kontainer untuk kartu informasi -->
    <div class="row">
        <div class="row flex-grow-1">
            <!-- Loop melalui setiap kartu yang tersedia -->
            @forelse ($cards ?? [] as $card)
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- Link ke rute yang ditentukan dalam kartu -->
                            <a href="{{ route($card['route']) }}" class="text-decoration-none text-reset">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <!-- Judul kartu dengan gaya khusus -->
                                    <h6 class="card-title mb-0"
                                        style="color: {{ $card['color'] }}; font-family: 'Nunito', sans-serif; font-weight: bold;">
                                        {{ $card['title'] }}</h6>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <!-- Menampilkan jumlah dari kartu -->
                                        <h3 class="mb-2">{{ $card['count'] }}</h3>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <!-- Menampilkan ikon dari kartu -->
                                        <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                            <iconify-icon icon="{{ $card['icon'] }}" width="36"
                                                height="36"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Pesan peringatan jika tidak ada kartu yang tersedia -->
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No cards available.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <!-- Menambahkan skrip untuk plugin flatpickr dan apexcharts -->
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <!-- Menambahkan skrip khusus untuk halaman dashboard -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
