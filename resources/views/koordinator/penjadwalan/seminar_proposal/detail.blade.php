@extends('layout.master')

@section('title', 'Detail Sidang Proposal')

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penjadwalan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Sidang Proposal</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Penjadwalan Sidang Proposal</h5>
                @if (is_null($data) || is_null($data->dosen_penguji_1) || is_null($data->dosen_penguji_2) || is_null($data->status))
                    <div class="card-body">
                        <form action="{{ route('jadwal-seminar-proposal-update', ['id' => $data->id_seminar_proposal]) }}"
                            method="POST" id="submitForm">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">NPM</label>
                                    <p><span>{{ $data->kode_unik }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">Nama Mahasiswa</label>
                                    <p><span>{{ $data->name }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">Judul</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->judul }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">Bidang Ilmu</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->topik_bidang_ilmu }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->dosen_pembimbing_utama }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->dosen_pembimbing_ii }}</span></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight:bold;">File Proposal</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly
                                        value="{{ basename($data->file_proposal) }}">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="window.open('{{ asset($data->file_proposal) }}', '_blank')">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" style="font-weight:bold;">File Slip Pembayaran</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly
                                        value="{{ basename($data->file_slip_pembayaran) }}">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="window.open('{{ asset($data->file_slip_pembayaran) }}', '_blank')">
                                        Lihat
                                    </button>
                                </div>
                            </div>
                            @if ($data->status == 'tolak')
                                {{-- <p>wle</p> --}}
                            @else
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight: bold">Ketua Seminar/Dosen Penguji
                                        1</label>
                                    <select class="form-select @error('dosen_penguji_1') is-invalid @enderror"
                                        id="select1" name="dosen_penguji_1" onchange="updateSelectOptions()">
                                        <option value="" selected disabled>Pilih dosen penguji 1</option>
                                        @foreach ($baru as $datas)
                                            @if ($datas->id != $data->dosen_pembimbing_utama)
                                                <option value="{{ $datas->id }}">{{ $datas->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('dosen_penguji_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight: bold">Dosen Penguji 2</label>
                                    <select class="form-select @error('dosen_penguji_2') is-invalid @enderror"
                                        id="select2" name="dosen_penguji_2"></select>
                                    @error('dosen_penguji_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-weight: bold">Ruangan Seminar</label>
                                        <select class="form-control @error('ruanganSeminar') is-invalid @enderror"
                                            id="ruanganSeminar" name="ruanganSeminar">
                                            <option value="" disabled selected>Pilih Ruangan</option>
                                            @foreach ($listRuangan as $ruangan)
                                                <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ruanganSeminar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-weight: bold">Tanggal</label>
                                        <input class="form-control @error('date') is-invalid @enderror" name="date"
                                            type="date" id="html5-date-input" />
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" style="font-weight: bold">Jam</label>
                                        <input class="form-control @error('time') is-invalid @enderror" name="time"
                                            type="time" id="html5-time-input" />
                                        @error('time')
                                            <div the="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ route('jadwal-seminar-proposal.index') }}';">Kembali</button>
                                @if ($data->status == 'tolak')
                                @else
                                    <div style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="btn btn-primary"
                                            onclick="showConfirmation2();">Buat Jadwal</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal]) }}"
                            method="POST" id="cetakForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">NPM</label>
                                    <p>{{ $data->kode_unik }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Nama Mahasiswa</label>
                                    <p class="text-capitalize">{{ $data->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Judul</label>
                                    <p class="text-capitalize">{{ $data->judul }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Bidang Ilmu</label>
                                    <p class="text-capitalize">{{ $data->topik_bidang_ilmu }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Dosen Pembimbing 1</label>
                                    <p class="text-capitalize">{{ $data->dosen_pembimbing_utama }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Dosen Pembimbing 2</label>
                                    <p class="text-capitalize">{{ $data->dosen_pembimbing_ii }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold;">File Proposal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly
                                            value="{{ basename($data->file_proposal) }}">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="window.open('{{ asset($data->file_proposal) }}', '_blank')">
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold;">File Slip Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly
                                            value="{{ basename($data->file_slip_pembayaran) }}">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="window.open('{{ asset($data->file_slip_pembayaran) }}', '_blank')">
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Ketua Seminar/Dosen Penguji
                                        1</label>
                                    <p>{{ $data2->nama_penguji_1 }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Dosen Penguji 2</label>
                                    <p>{{ $data2->nama_penguji_2 }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Ruangan Seminar</label>
                                    <p>{{ $data2->nama_ruangan }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Tanggal</label>
                                    @php
                                        $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                                        $formatTanggal = ucfirst($carbonTanggal->isoFormat('dddd, D MMMM Y'));
                                    @endphp
                                    <p>{{ $formatTanggal }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="font-weight:bold"">Jam</label>
                                    @php
                                        $carbonJam = \Carbon\Carbon::parse($data->jam);
                                        $formatJam = $carbonJam->format('H:i');
                                    @endphp
                                    <p>{{ $formatJam }}</p>
                                </div>
                            </div>
                            <input type="hidden" name="users_id" value="{{ $data2->users_id }}" />
                            <input type="hidden" name="seminar_proposal_id" value="{{ $data->id_seminar_proposal }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ route('jadwal-seminar-proposal.index') }}';">Kembali</button>
                                @if (is_null($data) || is_null($data->cetak))
                                    <button type="button" class="btn btn-primary"
                                        onclick="showConfirmation()">Cetak</button>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
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
    function updateSelectOptions() {
        var select1 = document.getElementById("select1");
        var select2 = document.getElementById("select2");

        // Clear existing options in select2
        select2.innerHTML = '<option value="" selected disabled>Pilih dosen penguji 2</option>';

        // Get the selected option from select1
        var selectedOption = select1.options[select1.selectedIndex];

        // Clone the options from select1 to select2, excluding the selected option
        for (var i = 0; i < select1.options.length; i++) {
            if (select1.options[i] !== selectedOption) {
                var option = document.createElement("option");
                option.value = select1.options[i].value;
                option.text = select1.options[i].text;
                select2.add(option);
            }
        }
    }
</script>
<script>
    function showConfirmation2() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin submit data?',
            text: 'Pastikan data sudah benar sebelum submit.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Submit!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform form validation
                var formIsValid = true;

                // Validate dosen_penguji_1
                var dosenPenguji1 = document.getElementById('select1').value;
                if (!dosenPenguji1) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 1 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate dosen_penguji_2
                var dosenPenguji2 = document.getElementById('select2').value;
                if (!dosenPenguji2) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 2 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate ruanganSeminar
                var ruanganSeminar = document.getElementById('ruanganSeminar').value;
                if (!ruanganSeminar) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Ruangan Seminar harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate date
                var date = document.getElementById('html5-date-input').value;
                if (!date) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Tanggal harus diisi.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate time
                var time = document.getElementById('html5-time-input').value;
                if (!time) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Waktu harus diisi.',
                        icon: 'error',
                    });
                    return;
                }

                // Jika formulir valid, submit formulir
                if (formIsValid) {
                    // Tampilkan pesan sukses sebelum reload
                    Swal.fire({
                        title: 'Pembaruan Jadwal Berhasil',
                        text: 'Jadwal Sidang Proposal berhasil diperbarui.',
                        icon: 'success',
                    }).then(() => {
                        // Submit form
                        document.getElementById('submitForm').submit();
                    });
                }
            }
        });
    }


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
                // Tampilkan pesan sukses sebelum reload
                Swal.fire({
                    title: 'Berita Acara Dibuat',
                    text: 'Berita Acara Sidang Proposal berhasil dibuat.',
                    icon: 'success',
                }).then(() => {
                    // Submit form cetak
                    document.getElementById('cetakForm').submit();
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        // Handle SweetAlert confirmation when submitting the form
        $('#submitForm').submit(function(e) {
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
        $('#rejectBtn').on('click', function() {
            $('#rejectModal').modal('show');
        });

        // Handle reject confirmation
        $('#rejectSubmitBtn').on('click', function() {
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
                url: '{{ route('jadwal-seminar-proposal-tolak', ['id' => $data->id_seminar_proposal]) }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'tolak',
                    rejectReason: rejectReason
                },
                success: function(response) {
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
                            window.location.href =
                                '{{ route('jadwal-seminar-proposal.index') }}';
                        }
                    });
                },
                error: function(error) {
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
