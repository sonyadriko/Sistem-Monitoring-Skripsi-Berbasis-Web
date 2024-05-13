@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title', 'Data Pengguna')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0">Manajemen Data Pengguna</h4>
    </div>
    <p class="mb-4">Data pengguna dapat dilihat dibawah ini.</p>

    <div class="row">
        <div class="row flex-grow-1">
            @php
                $userCards = [
                    [
                        'route' => 'data-pengguna-mhs.index',
                        'title' => 'Mahasiswa',
                        'count' => $mahasiswaCount,
                        'icon' => 'mdi:account-multiple',
                        'color' => '#4CAF50', // Green
                    ],
                    [
                        'route' => 'data-pengguna-dosen.index',
                        'title' => 'Dosen',
                        'count' => $dosenCount,
                        'icon' => 'mdi:account-tie',
                        'color' => '#FFC107', // Amber
                    ],
                    [
                        'route' => 'data-pengguna-kajur.index',
                        'title' => 'Ketua Jurusan',
                        'count' => $kajurCount,
                        'icon' => 'mdi:account-supervisor',
                        'color' => '#2196F3', // Blue
                    ],
                    [
                        'route' => 'data-pengguna-penggunabaru.index',
                        'title' => 'Registrasi User',
                        'count' => $newUserCount,
                        'icon' => 'mdi:account-plus',
                        'color' => '#F44336', // Red
                    ],
                ];
            @endphp
            @foreach ($userCards as $card)
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route($card['route']) }}" class="card-link text-reset">
                                <h6 class="card-title mb-0" style="color: {{ $card['color'] }};">{{ $card['title'] }}</h6>
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
