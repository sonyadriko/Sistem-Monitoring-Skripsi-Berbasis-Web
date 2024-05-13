@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Dashboard')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
    </div>
    <h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi</h6>

    <div class="row">
        <div class="row flex-grow-1">
            @foreach ([['route' => 'data-pengguna-mhs.index', 'title' => 'Mahasiswa', 'count' => $mahasiswaCount, 'icon' => 'mdi:account-multiple', 'color' => '#4CAF50'], ['route' => 'data-pengguna-dosen.index', 'title' => 'Dosen Pembimbing', 'count' => $dosenCount, 'icon' => 'mdi:account-tie', 'color' => '#FFC107'], ['route' => 'pengajuan-judul.index', 'title' => 'Pengajuan Masuk', 'count' => $pengajuanCount, 'icon' => 'mdi:file-document-edit', 'color' => '#224ABE'], ['route' => 'data-pengguna-penggunabaru.index', 'title' => 'Registrasi Baru', 'count' => $newUserCount, 'icon' => 'mdi:account-plus', 'color' => '#F44336']] as $item)
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route($item['route']) }}" class="text-decoration-none text-reset">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0"
                                        style="color: {{ $item['color'] }}; font-family: 'Nunito', sans-serif; font-weight: bold;">
                                        {{ $item['title'] }}
                                    </h6>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <h3 class="mb-2">{{ $item['count'] }}</h3>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <div class="mt-md-3 mt-xl-0 d-flex justify-content-end">
                                            <iconify-icon icon="{{ $item['icon'] }}" width="36"
                                                height="36"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush
@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
