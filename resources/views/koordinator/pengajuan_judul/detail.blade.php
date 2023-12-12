@extends('layout.master')

@section('title')
Detail Pengajuan Tema
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Penjadwalan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pengajuan Seminar Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-4">
            <h5 class="card-header">Form Pengajuan</h5>
            <div class="card-body">
                <form action="{{ route('update_status', ['id' => $data->id_pengajuan_judul]) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mahasiswa</label>
                        <input class="form-control" type="text" id="name" name="nama" value="{{ $data->name }}" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM Mahasiswa</label>
                        <input class="form-control" type="text" id="npm" value="{{ $data->kode_unik }}" name="npm" placeholder="13.2019.1.00819" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Rencana Tema Proposal Skripsi</label>
                        <textarea class="form-control" id="judul" name="judul" rows="3" placeholder="Masukan rencana tema/judul penelitian">{{$data->judul}}</textarea>
                        {{-- <p class="text-danger"> Maksimal 12 kata.</p> --}}
                    </div>
                    <div class="mb-3">
                        <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
                        <input class="form-control" type="text" id="tbi" value="{{ $data->topik_bidang_ilmu }}" name="tbi" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="tbi" class="form-label">Mata Kuliah Pilihan Semester VIII dan VII</label>
                        <input class="form-control" type="text" id="tbi" value="{{ $data->mk_pilihan }}" name="tbi" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="dosen_pembimbing_utama" class="form-label">Dosen Pembimbing Utama</label>
                        <select class="form-select" id="select1" name="dosen_pembimbing_utama" aria-label="Default select example">
                            <option value="" selected disabled>Open this select menu</option>
                            @foreach($dosen2 as $dosen)
                                <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dosen_pembimbing_ii" class="form-label">Dosen Pembimbing II</label>
                        <select class="form-select" id="select2" name="dosen_pembimbing_ii" aria-label="Default select example">
                            <option value="" selected disabled>Open this select menu</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>


                    <input type="hidden" name="pengajuan_id" value="{{ $data->id_pengajuan_judul }}" />
                    <input type="hidden" name="bidang_ilmu_id" value="{{ $data->bidang_ilmu_id }}" />
                    <input type="hidden" name="users_id" value="{{ $data->users_id }}" />

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>

                        <div style="display: flex; justify-content: flex-end;">
                            @if ($data->status === 'pending')
                                <button type="submit" class="btn btn-primary" name="action" value="terima" style="margin-right: 10px;">Terima</button>
                                <button type="submit" class="btn btn-primary" name="action" value="tolak">Tolak</button>
                            @elseif ($data->status === 'terima')
                                <p>Data ini telah diterima.</p>
                            @elseif ($data->status === 'tolak')
                                <p>Data ini telah ditolak.</p>
                            @endif
                        </div>
                    </div>
                </form>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#select1').change(function () {
            var selectedDosenUtama = $(this).val();

            // Clear existing options in the second dropdown
            $('#select2').empty();

            // Add default option
            $('#select2').append('<option value="" selected disabled>Open this select menu</option>');
            $('#select2').append('<option value="tidak ada" >Tidak Ada</option>');

            // Add options based on the selected Dosen Pembimbing Utama
            @foreach($dosen2 as $datas)
                if ("{{ $datas->name }}" !== selectedDosenUtama) {
                    $('#select2').append('<option value="{{ $datas->name }}">{{ $datas->name }}</option>');
                }
            @endforeach
        });
    });
</script>


<script>
  function showConfirmation() {
      Swal.fire({
          title: 'Apakah Anda yakin ingin mencetak?',
          text: 'Pastikan data sudah benar sebelum mencetak.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Cetak!'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('cetakForm').submit();
          }
      });
  }
  </script>
