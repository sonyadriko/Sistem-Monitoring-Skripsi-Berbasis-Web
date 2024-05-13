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
            @php
                $cards = [
                    [
                        'route' => 'data-mhs',
                        'title' => 'Mahasiswa',
                        'count' => $mahasiswaCount,
                        'icon' => 'mdi:account-multiple',
                        'color' => '#4A90E2', // Updated color
                    ],
                    [
                        'route' => 'data-dsn',
                        'title' => 'Dosen Pembimbing',
                        'count' => $dosenCount,
                        'icon' => 'mdi:account-tie',
                        'color' => '#50E3C2', // Updated color
                    ],
                    [
                        'route' => 'data-bi',
                        'title' => 'Bidang Ilmu',
                        'count' => $bidangIlmuCount,
                        'icon' => 'mdi:book-open-page-variant',
                        'color' => '#9013FE', // Updated color
                    ],
                    [
                        'route' => 'data-jadwal',
                        'title' => 'Jadwal',
                        'count' => $total,
                        'icon' => 'mdi:calendar-clock',
                        'color' => '#F5A623', // Updated color
                    ],
                ];
            @endphp
            @foreach ($cards as $card)
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route($card['route']) }}" class="card-link text-reset">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0"
                                        style="color: {{ $card['color'] }}; font-family: 'Nunito', sans-serif; font-weight: bold;">
                                        {{ $card['title'] }}
                                    </h6>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <h3 class="mb-2">{{ $card['count'] }}</h3>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-5">
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
