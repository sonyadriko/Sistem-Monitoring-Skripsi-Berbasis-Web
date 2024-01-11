@extends('layout.master')

@section('title')
Detail Pengajuan Judul
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">


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
                @if ($data->status === 'pending')
                <form action="{{ route('update_status', ['id' => $data->id_pengajuan_judul]) }}" method="POST" id="form-id">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Mahasiswa</label>
                        <input class="form-control" type="text" id="name" name="nama" value="{{ $data->name }}" readonly disabled/>
                    </div>

                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM Mahasiswa</label>
                        <input class="form-control" type="text" id="npm" value="{{ $data->kode_unik }}" name="npm" placeholder="13.2019.1.00819" readonly disabled />
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Rencana Judul Proposal Skripsi</label>
                        <input class="form-control" type="text" id="judul" value="{{ $data->judul }}" name="judul" placeholder="13.2019.1.00819" readonly disabled/>
                    </div>
                    <div class="mb-3">
                        <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
                        <input class="form-control" type="text" id="tbi" value="{{ $data->topik_bidang_ilmu }}" name="tbi" readonly disabled/>
                    </div>
                    <div class="mb-3">
                        <label for="tbi" class="form-label">Mata Kuliah Pilihan Semester VIII dan VII</label>
                        <input class="form-control" type="text" id="tbi" value="{{ $data->mk_pilihan }}" name="tbi" readonly disabled/>
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
                            @if($data->status == 'tolak')

                            @else
                                <button type="button" class="btn btn-primary" id="btn-terima">Terima</button>

                                @endif
                        </div>
                    </div>
                </form>
                    @if($data->status == 'tolak')

                    @else

                    <form action="{{ route('pengajuan-judul-tolak', ['id' => $data->id_pengajuan_judul]) }}" method="POST">
                        @csrf
                        <!-- ... form fields ... -->
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="button" class="btn btn-danger" id="rejectBtn">Tolak</button>

                        </div>
                    </form>
                    @endif
                @else
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input class="form-control" type="text" id="name" name="nama" value="{{ $data->name }}" readonly disabled/>
                </div>

                <div class="mb-3">
                    <label for="npm" class="form-label">NPM Mahasiswa</label>
                    <input class="form-control" type="text" id="npm" value="{{ $data->kode_unik }}" name="npm" placeholder="13.2019.1.00819" readonly disabled />
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Rencana Judul Proposal Skripsi</label>
                    <input class="form-control" type="text" id="judul" value="{{ $data->judul }}" name="judul" placeholder="13.2019.1.00819" readonly disabled/>
                </div>
                <div class="mb-3">
                    <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data->topik_bidang_ilmu }}" name="tbi" readonly disabled/>
                </div>
                <div class="mb-3">
                    <label for="tbi" class="form-label">Mata Kuliah Pilihan Semester VIII dan VII</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data->mk_pilihan }}" name="tbi" readonly disabled/>
                </div>
                <div class="mb-3">
                    <label for="tbi" class="form-label">Dosen Pembimbing Utama</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data2->dosen_pembimbing_utama ?? 'Pengajuan ditolak' }}" name="tbi" readonly disabled/>
                </div>
                <div class="mb-3">
                    <label for="tbi" class="form-label">Dosen Pembimbing II</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data2->dosen_pembimbing_ii ?? 'Pengajuan ditolak' }}" name="tbi" readonly disabled/>
                </div>
                <input type="hidden" name="pengajuan_id" value="{{ $data->id_pengajuan_judul }}" />
                <input type="hidden" name="bidang_ilmu_id" value="{{ $data->bidang_ilmu_id }}" />
                <input type="hidden" name="users_id" value="{{ $data->users_id }}" />

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>

                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Tolak Pengajuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="rejectReason" class="form-label">Alasan Penolakan:</label>
          <textarea class="form-control" id="rejectReason" name="rejectReason" rows="3"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="rejectSubmitBtn">Tolak</button>
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
<!-- ... Your HTML and other scripts ... -->

<script>
$(document).ready(function () {
    // Add SweetAlert confirmation when submitting the form
    $('#btn-terima').click(function () {
        // Get the selected values from the form
        var selectedDosenUtama = $('#select1').val();
        var selectedDosenII = $('#select2').val();

        // Check if the required fields are filled
        if (selectedDosenUtama && selectedDosenII) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menerima pengajuan ini?',
                text: 'Pastikan data sudah benar sebelum mengonfirmasi.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Terima!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user clicks 'Ya, Terima!', proceed with form submission
                    $.ajax({
                        type: 'POST',
                        url: $('#form-id').attr('action'),
                        data: $('#form-id').serialize(),  // Serialize the form data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success (if needed)
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Pengajuan diterima.',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Optionally redirect to another page or perform other actions
                                    window.location.href = '{{ route('pengajuan-judul.index') }}';
                                }
                            });
                        },
                        error: function (error) {
                            // Handle error (if needed)
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan. Silakan coba lagi.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        } else {
            // Display SweetAlert for validation error
            Swal.fire({
                title: 'Gagal!',
                text: 'Pastikan semua bidang terisi.',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>
<script>
    $(document).ready(function () {
    // Add SweetAlert confirmation when submitting the form
    $('#form-id').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting

        Swal.fire({
            title: 'Apakah Anda yakin ingin menerima atau menolak pengajuan ini?',
            text: 'Pastikan data sudah benar sebelum mengonfirmasi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terima!',
            cancelButtonText: 'Tolak'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks 'Ya, Terima!', proceed with form submission
                // ... your existing code for accepting
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // If user clicks 'Tolak', show reject modal
                $('#rejectModal').modal('show');
            }
        });
    });

    // Handle reject confirmation when modal is opened
    $('#rejectBtn').on('click', function () {
        $('#rejectModal').modal('show');
    });

    // Handle reject confirmation
    $('#rejectSubmitBtn').on('click', function () {
        var rejectReason = $('#rejectReason').val();

        // Check if rejectReason is empty
        if (rejectReason.trim() === '') {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Mohon masukkan alasan penolakan.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return; // Stop further processing if rejectReason is empty
        }

        // Perform AJAX request to submit rejection with reason
        $.ajax({
            type: 'POST',
            url: '{{ route('pengajuan-judul-tolak', ['id' => $data->id_pengajuan_judul]) }}',
            data: {
                _token: '{{ csrf_token() }}',
                action: 'tolak',
                rejectReason: rejectReason
            },
            success: function (response) {
                // Handle success (if needed)
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pengajuan ditolak.',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Optionally redirect to another page or perform other actions
                        window.location.href = '{{ route('pengajuan-judul.index') }}';
                    }
                });
            },
            error: function (error) {
                // Handle error (if needed)
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

</script>
