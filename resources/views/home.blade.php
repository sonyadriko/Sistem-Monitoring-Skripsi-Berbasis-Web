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
	<!-- Menampilkan pesan selamat datang kepada pengguna yang telah login -->
	<h4 class="mb-2">Selamat Datang <strong>{{ Auth::user()->name }}</strong></h4>
	<!-- Deskripsi singkat tentang halaman dashboard -->
	<h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi Jurusan Sistem Informasi ITATS.</h6>

	<div class="row">
		<div class="col-lg-12 col-xl-12 grid-margin stretch-card">
			<div class="card">
				<h6 class="card-header font-weight-bold">Progress Skripsi</h6>
				<div class="card-body">
					<div class="p-2">
						<!-- Bar progress untuk menunjukkan persentase kemajuan skripsi -->
						<div class="progress" style="height: 20px;">
							<div class="progress-bar progress-bar-animated" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progressPercentage }}%</div>
						</div>
						<div class="row mt-1">
							@foreach ($tables as $key => $table)
								@if (Agent::isMobile() && $loop->last)
									{{-- <div class="col-lg m-2 text-left font-weight-bold">{{ ucwords(str_replace('_', ' ', $table)) }}</div> --}}
								@elseif (!Agent::isMobile())
									<!-- Menampilkan nama tabel pada perangkat non-mobile -->
									<div class="col-sm m-2 text-center font-weight-bold">{{ ucwords(str_replace('_', ' ', $table)) }}</div>
								@endif
							@endforeach
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-lg">
							<!-- Menampilkan pesan berdasarkan persentase kemajuan skripsi -->
							@if ($progressPercentage == 0)
								<span class="mt-2">Anda belum memulai tahap skripsi</span>
							@elseif($progressPercentage > 0 && $progressPercentage <= 10)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong> Pengajuan Judul</strong></span>
							@elseif($progressPercentage > 10 && $progressPercentage <= 20)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong> Bimbingan Proposal</strong></span>
							@elseif($progressPercentage > 20 && $progressPercentage <= 30)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Sidang Proposal</strong></span>
							@elseif($progressPercentage > 30 && $progressPercentage <= 40)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Revisi Sidang Proposal</strong></span>
							@elseif($progressPercentage > 40 && $progressPercentage <= 50)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Surat Tugas</strong></span>
							@elseif($progressPercentage > 50 && $progressPercentage <= 62.5)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Bimbingan Skripsi</strong></span>
							@elseif($progressPercentage > 62.5 && $progressPercentage <= 75)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Sidang Skripsi</strong></span>
							@elseif($progressPercentage > 75.0 && $progressPercentage <= 87.5)
								<span class="mt-2">Progress diatas menampilkan bahwa anda sekarang sedang menyelesaikan <strong>Revisi Sidang Skripsi</strong></span>
							@elseif($progressPercentage > 87.5 && $progressPercentage <= 100)
								<span class="mt-2">Selamat, <strong> Skripsi Telah Selesai</strong></span>
							@else
								<span class="mt-2">Selamat, Proses Skripsi Telah Selesai</span>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-xl-5 grid-margin stretch-card">
			<div class="card">
				<h6 class="card-header font-weight-bold">Info Penting</h6>
				<div class="card-body text-center">
					<img alt="Additional Information" class="img-fluid" src="{{ asset('img/info_penting.svg') }}" style="width: 100%; max-width: 100%; height: auto;">
					<p class="text-dark mb-2 mt-4">Pengajuan proposal skripsi hanya dapat dilakukan oleh mahasiswa yang sudah melewati semester 6, dan sudah menempuh mata kuliah yang akan dijadikan sebagai topik proposal skripsi.</p>
					<p class="mt-4">Untuk informasi lebih lanjut, <a href="{{ route('faq') }}">Lihat lebih banyak</a>.</p>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-xl-2 grid-margin">
			<div class="card">
				<h6 class="card-header mb-0" style="font-weight: bold">Download Template tersedia</h6>
				<div class="card-body">
					<p class="text-dark">Template Proposal Skripsi.</p>
					<button class="btn btn-dark btn-block text-center" onclick="window.open('{{ asset('Template Proposal Skripsi.docx') }}', '_blank')">
                        <iconify-icon height="24" icon="lucide:download-cloud" style="margin-left: 12px" width="24"></iconify-icon>
                        <span style="margin-left: 7px; margin-right: 12px; margin-top: 6px; margin-bottom: 6px">Proposal Skripsi</span>
                    </button>
                </div>
			</div>
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
