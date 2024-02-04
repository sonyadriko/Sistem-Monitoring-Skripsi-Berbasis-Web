@extends('layout.master')

@push('plugin-styles')
	<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
	Dashboard
@endsection

@section('content')
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif
	<div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">

		<div>
			<h4 class="mb-md-0 mb-3">Selamat Datang</h4>
		</div>
	</div>
	<h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi Jurusan Sistem Informasi ITATS.</h6>

	<div class="row">
		<div class="col-lg-12 col-xl-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 style="font-weight: bold">Progress Skripsi</h6>
					<div class="progress mt-4">
						<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{ $progressPercentage }}" class="progress-bar progress-bar-animated" role="progressbar" style="width: {{ $progressPercentage }}%;">{{ $progressPercentage }}%</div>
					</div>
					<div class="row mt-1">
						@foreach ($tables as $table)
							<div class="col text-center" style="font-weight: bold">{{ ucwords(str_replace('_', ' ', $table)) }}</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-xl-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-baseline mb-2">
						<h6 class="card-title mb-0">Info Penting</h6>
					</div>
					<div class="col-lg-5 col-xl-4 grid-margin stretch-card mx-auto">
						<div class="card">
							<div class="card-body text-center">
								<img alt="Additional Information" class="img-fluid mx-auto" src="{{ asset('img/undraw_add_information_j2wg.svg') }}" style="width: 100%; max-width: 100%; height: auto;">
							</div>
						</div>
					</div>

					<p class="text-dark mb-2">Pengajuan proposal skripsi hanya dapat dilakukan oleh mahasiswa yang sudah melewati semester 6, dan sudah menempuh mata kuliah yang akan dijadikan sebagai topik proposal skripsi.</p>
					<p class="mt-4">Untuk informasi lebih lanjut, <a href="{{ route('faq') }}">Lihat lebih banyak</a>.</p>
				</div>
			</div>
		</div>
	</div>

	{{-- !-- row --> --}}
@endsection

@push('plugin-scripts')
	<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
	<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
