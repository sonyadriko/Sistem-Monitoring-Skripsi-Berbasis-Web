@extends('layout.master')

@section('title')
Detail Sidang Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Daftar Jadwal</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sidang Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">Data Sidang Proposal</h5>
          <div class="card-body">
              <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="npm" class="form-label" style="font-weight: bold">NPM</label>
                    <p><span>{{ $data->kode_unik }}</span></p>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label" style="font-weight: bold">Nama Mahasiswa</label>
                    <p><span>{{ $data->name }}</span></p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="npm" class="form-label" style="font-weight: bold">Judul</label>
                    <p><span>{{ $data->judul }}</span></p>
                </div>
                <div class="col-md-6">
                    <label for="bidang_ilmu" class="form-label" style="font-weight: bold">Bidang Ilmu</label>
                    <p><span>{{ $data->topik_bidang_ilmu }}</span></p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="dospem_utama" class="form-label" style="font-weight: bold">Dosen Pembimbing 1</label>
                    <p><span>{{ $data->dosen_pembimbing_utama }}</span></p>
                </div>
                <div class="col-md-6">
                    <label for="dospem_2" class="form-label" style="font-weight: bold">Dosen Pembimbing 2</label>
                    <p><span>{{ $data->dosen_pembimbing_ii }}</span></p>
                </div>
            </div>
              <div class="mb-3 row">
                <div class="col-md-6">
                <label for="defaultFormControlInput" class="form-label" style="font-weight: bold">File Proposal</label>
                  <p> <a href="{{ asset($data->file_proposal) }}" type="application/pdf" target="_blank">{{basename($data->file_proposal)}}</a>.</p>
                </div>
                <div class="col-md-6">
                <label for="defaultFormControlInput" class="form-label" style="font-weight: bold">File Slip Pembayaran</label>
                  <p> <a href="{{ asset($data->file_slip_pembayaran) }}" type="application/pdf" target="_blank">{{basename($data->file_slip_pembayaran)}}</a>.</p>
                </div>
            </div>
              <div class="mb-3 row">
                <div class="col-md-6">

                <label for="dosen_penguji_1" class="form-label" style="font-weight: bold">Ketua Seminar/Dosen Penguji 1</label>
                <p><span>{{ $data2->nama_penguji_1 ?? 'Belum diatur' }}</span></p>
              </div>
              <div class="col-md-6">
                <label for="dosen_penguji_2" class="form-label" style="font-weight: bold">Dosen Penguji 2</label>
                <p><span>{{ $data2->nama_penguji_2 ?? 'Belum diatur' }}</span></p>
              </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan Seminar</label>
                  <p><span>{{ $data2->nama_ruangan ?? 'Belum diatur' }}</span></p>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label" style="font-weight: bold">Tanggal</label>
                    @php
                        $formatTanggal = null;
                        if(!is_null($data->tanggal)) {
                            $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                            $formatTanggal = ucfirst($carbonTanggal->formatLocalized('%A, %d %B %Y', strftime('%A')));
                        }
                    @endphp
                    <p><span>{{ $formatTanggal ?? 'Belum diatur' }}</span></p>
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label" style="font-weight: bold">Jam</label>
                    @php
                        $formatJam = null;
                        if (!is_null($data->jam)) {
                            $carbonJam = \Carbon\Carbon::parse($data->jam);
                            $formatJam = $carbonJam->format('H:i');
                        }
                    @endphp
                    <p><span>{{ $formatJam ?? 'Belum diatur' }}</span></p>
                </div>
              </div>
              {{-- <input type="hidden" name="users_id" value="{{$data2->users_id}}" />
              <input type="hidden" name="seminar_proposal_id" value="{{$data->id_seminar_proposal}}" /> --}}

              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              </div>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

