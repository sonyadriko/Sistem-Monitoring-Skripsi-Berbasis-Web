@extends('layout.master')

@section('title')
Detail Surat Tugas
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Proposal & Skripsi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Surat Tugas</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">Detail Pengajuan Surat Tugas</h5>
            <div class="card-body">
                <form action="{{ route('koor-surat-tugas.update', ['id' => $data->id_surat_tugas]) }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="npm" class="form-label">NPM</label>
                    <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly  disabled/>
                  </div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly disabled />
                  </div>
                  <div class="mb-3">
                    <label for="bidang_ilmu" class="form-label">Alamat Mahasiswa</label>
                    <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->alamat_mhs}}" aria-describedby="defaultFormControlHelp" readonly disabled />
                  </div>
                  <div class="mb-3">
                    <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                    <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly disabled />
                  </div>
                  <div class="mb-3">
                    <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                    <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly disabled />
                  </div>
                  <div class="mb-3">
                    <label for="dospem_2" class="form-label">Tanggal Seminar Proposal</label>
                            @php
                                $carbonTanggal = \Carbon\Carbon::parse($data->tanggal_sidang_proposal);
                                $formatTanggal = $carbonTanggal->formatLocalized(' %d %B %Y', 'id');
                            @endphp
                        {{-- <p><span>{{ $formatTanggal }}</span></p> --}}
                    <input type="text" class="form-control" name="tgl_seminar" id="tgl_seminar" value="{{$formatTanggal}}" aria-describedby="defaultFormControlHelp" readonly disabled/>
                  </div>
                  <input type="hidden" value="{{ $data->bimbingan_proposal_id}}" id="bimproid" name="bimproid"/>
                  <input type="hidden" value="{{ $data->users_id}}" id="users_id" name="users_id"/>
                  <div class="mb-3">
                    <label class="form-label">File Proposal</label>
                    <a href="{{asset($data->file_proposal) }}" target="_blank">
                        {{basename($data->file_proposal)}}
                    </a>
                    {{-- <button type="button" class="btn btn-outline-primary" onclick="window.open('{{ asset($data->file_proposal) }}', '_blank')">
                        View Proposal
                    </button> --}}
                </div>
                <div class="mb-3">
                    <label  class="form-label">Slip Pembayaran Bimbingan</label>
                    <a href="{{ asset($data->file_slip_pembayaran) }}" target="_blank">
                        {{basename($data->file_slip_pembayaran)}}
                    </a>
                    {{-- <button type="button" class="btn btn-outline-primary" onclick="window.open('{{ asset($data->file_slip_pembayaran) }}', '_blank')">
                        {{basename($data->file_slip_pembayaran)}}
                    </button> --}}
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                  @if($data->status == 'pending')
                  <button type="submit" id="submitBtn" class="btn btn-primary">Cetak</button>
                  @elseif($data->status == 'terima')
                  <p>Data ini telah diterima.</p>
                  @elseif($data->status == 'tolak')
                  <p>Data ini telah ditolak.</p>
                    @endif
                </div>
            </form>

            <form action="{{ route('koor-surat-tugas-tolak', ['id' => $data->id_surat_tugas]) }}" method="POST">
                @csrf
                <!-- ... form fields ... -->
                @if($data->status == 'pending')
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn btn-danger mt-4" name="action" value="tolak">Tolak</button>
                </div>
                @endif
            </form>
          </div>
        </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Data updated successfully.',
          confirmButtonText: 'OK',
          showCancelButton: false,
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          willClose: () => {
            window.location.href = "/proposal";
          }
        });
      });
    });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
