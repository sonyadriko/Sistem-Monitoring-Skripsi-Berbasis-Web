@extends('layout.master')

@push('plugin-styles')
    <!-- Link to Flatpickr CSS for date-time picker UI -->
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Dashboard')

@section('content')
    <!-- Success message display block -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Dashboard header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
    </div>
    <!-- Description text for the dashboard -->
    <h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi</h6>

    <!-- Cards container -->
    <div class="row">
        <div class="row flex-grow-1">
            @php
                // Define cards data for dashboard statistics
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
            <!-- Loop through each card and display its content -->
            @foreach ($cards as $card)
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- Link to specific route with card details -->
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
                                        <!-- Icon display using Iconify -->
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
    <!-- Link to Flatpickr JS for date-time picker functionality -->
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <!-- Link to ApexCharts JS for charting solutions -->
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <!-- Link to custom dashboard-specific JavaScript -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
