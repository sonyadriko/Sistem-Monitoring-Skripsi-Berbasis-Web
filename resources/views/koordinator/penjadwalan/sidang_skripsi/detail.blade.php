@extends('layout.master')

@section('title', 'Detail Sidang Skripsi')

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
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Sidang Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Penjadwalan Sidang Skripsi</h5>
                @if (is_null($data) || is_null($data->dosen_penguji_1) || is_null($data->dosen_penguji_2))
                    <div class="card-body">
                        <form action="{{ route('jadwal-sidang-skripsi-update', ['id' => $data->id_sidang_skripsi]) }}"
                            method="POST" id="submitForm">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="npm" class="form-label" style="font-weight: bold">NPM</label>
                                    <p><span>{{ $data->kode_unik }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label" style="font-weight: bold">Nama
                                        Mahasiswa</label>
                                    <p><span>{{ $data->name }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="npm" class="form-label" style="font-weight: bold">Judul</label>
                                    <p><span>{{ $data->judul }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="bidang_ilmu" class="form-label" style="font-weight: bold">Bidang
                                        Ilmu</label>
                                    <p><span>{{ $data->topik_bidang_ilmu }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="dospemUtama" class="form-label" style="font-weight: bold">Dosen Pembimbing
                                        1</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->dosen_pembimbing_utama }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label for="dospem2" class="form-label" style="font-weight: bold">Dosen Pembimbing
                                        2</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->dosen_pembimbing_ii }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="fileSkripsi" class="form-label font-weight-bold">File Skripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fileSkripsi"
                                            value="{{ basename($data->file_skripsi) }}" aria-describedby="fileSkripsiAddon"
                                            readonly>
                                        <div class="input-group-append">
                                            <a href="{{ asset($data->file_skripsi) }}" class="btn btn-outline-primary"
                                                target="_blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fileSlipPembayaran" class="form-label font-weight-bold">File Slip
                                        Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fileSlipPembayaran"
                                            value="{{ basename($data->file_slip_pembayaran) }}"
                                            aria-describedby="fileSlipPembayaranAddon" readonly>
                                        <div class="input-group-append">
                                            <a href="{{ asset($data->file_slip_pembayaran) }}"
                                                class="btn btn-outline-primary" target="_blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="select1" class="form-label" style="font-weight: bold">Ketua Seminar/Dosen
                                    Penguji 1</label>
                                <select class="form-select @error('dosenPenguji1') is-invalid @enderror" id="select1"
                                    name="dosenPenguji1" aria-label="Default select example"
                                    onchange="updateSelectOptions()">
                                    <option value="" selected disabled>Pilih dosen penguji 1</option>
                                    @foreach ($baru as $datas)
                                        <option value="{{ $datas->id }}">{{ $datas->name }}</option>
                                    @endforeach
                                </select>
                                @error('dosenPenguji1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="select2" class="form-label" style="font-weight: bold">Dosen Penguji
                                    2</label>
                                <select class="form-select @error('dosenPenguji2') is-invalid @enderror" id="select2"
                                    name="dosenPenguji2" aria-label="Default select example">
                                    <option value="" selected disabled>Pilih dosen penguji 2</option>
                                </select>
                                @error('dosenPenguji2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="select3" class="form-label" style="font-weight: bold">Dosen Penguji
                                    3</label>
                                <select class="form-select @error('dosenPenguji3') is-invalid @enderror" id="select3"
                                    name="dosenPenguji3" aria-label="Default select example">
                                    <option value="" selected disabled>Pilih dosen penguji 3</option>
                                </select>
                                @error('dosenPenguji3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="select4" class="form-label" style="font-weight: bold">Sekretaris</label>
                                <select class="form-select @error('sekretaris') is-invalid @enderror" id="select4"
                                    name="sekretaris" aria-label="Default select example">
                                    <option value="" selected disabled>Pilih Sekretaris</option>
                                </select>
                                @error('sekretaris')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan
                                        Sidang</label>
                                    <select class="form-control" id="ruanganSeminar" name="ruanganSeminar">
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
                                    <label for="html5-date-input" class="form-label"
                                        style="font-weight: bold">Tanggal</label>
                                    <input class="form-control" name="date" type="date" id="html5-date-input" />
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="html5-time-input" class="form-label"
                                        style="font-weight: bold">Jam</label>
                                    <input class="form-control" name="time" type="time" id="html5-time-input" />
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back();">Kembali</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="showConfirmation2();">Submit</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <form action="{{ route('cetak-berita-acara-s', ['id' => $data->id_sidang_skripsi]) }}"
                            method="POST" id="cetakForm">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="npm" class="form-label" style="font-weight: bold">NPM</label>
                                    <p><span>{{ $data->kode_unik }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label" style="font-weight: bold">Nama
                                        Mahasiswa</label>
                                    <p><span>{{ $data->name }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="npm" class="form-label" style="font-weight: bold">Judul</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->judul }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="bidang_ilmu" class="form-label" style="font-weight: bold">Bidang
                                        Ilmu</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->topik_bidang_ilmu }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="dospemUtama" class="form-label" style="font-weight: bold">Dosen
                                        Pembimbing 1</label>
                                    <p><span
                                            style="text-transform: capitalize;">{{ $data->dosen_pembimbing_utama }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label for="dospem2" class="form-label" style="font-weight: bold">Dosen Pembimbing
                                        2</label>
                                    <p><span style="text-transform: capitalize;">{{ $data->dosen_pembimbing_ii }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="fileSkripsi" class="form-label font-weight-bold">File Skripsi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fileSkripsi"
                                            value="{{ basename($data->file_skripsi) }}"
                                            aria-describedby="fileSkripsiAddon" readonly>
                                        <div class="input-group-append">
                                            <a href="{{ asset($data->file_skripsi) }}" class="btn btn-outline-primary"
                                                target="_blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fileSlipPembayaran" class="form-label font-weight-bold">File Slip
                                        Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fileSlipPembayaran"
                                            value="{{ basename($data->file_slip_pembayaran) }}"
                                            aria-describedby="fileSlipPembayaranAddon" readonly>
                                        <div class="input-group-append">
                                            <a href="{{ asset($data->file_slip_pembayaran) }}"
                                                class="btn btn-outline-primary" target="_blank">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="dosenPenguji1" class="form-label" style="font-weight: bold">Ketua
                                        Seminar/Dosen Penguji 1</label>
                                    <p><span>{{ $data2->nama_penguji_1 }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="dosenPenguji2" class="form-label" style="font-weight: bold">Dosen Penguji
                                        2</label>
                                    <p><span>{{ $data2->nama_penguji_2 }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="dosenPenguji3" class="form-label" style="font-weight: bold">Dosen Penguji
                                        3</label>
                                    <p><span>{{ $data2->nama_penguji_3 }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="sekretaris" class="form-label"
                                        style="font-weight: bold">Sekretaris</label>
                                    <p><span>{{ $data2->nama_sekretaris }}</span></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan
                                        Seminar</label>
                                    <p><span>{{ $data2->nama_ruangan }}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="html5-date-input" class="form-label"
                                        style="font-weight: bold">Tanggal</label>
                                    @php
                                        $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                                        $formatTanggal = ucfirst(
                                            $carbonTanggal->formatLocalized('%A, %d %B %Y', strftime('%A')),
                                        );
                                    @endphp
                                    <p><span>{{ $formatTanggal }}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="html5-time-input" class="form-label"
                                        style="font-weight: bold">Jam</label>
                                    @php
                                        $carbonJam = \Carbon\Carbon::parse($data->jam);
                                        $formatJam = $carbonJam->format('H:i');
                                    @endphp
                                    <p><span>{{ $formatJam }}</span></p>
                                </div>
                            </div>
                            <input type="hidden" name="users_id" value="{{ $data2->users_id }}" />
                            <input type="hidden" name="sidang_skripsi_id" value="{{ $data->id_sidang_skripsi }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back();">Kembali</button>
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
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function updateSelectOptions() {
        var select1 = document.getElementById("select1");
        var select2 = document.getElementById("select2");
        var select3 = document.getElementById("select3");
        var select4 = document.getElementById("select4");

        // Clear existing options in select2, select3, and select4
        select2.innerHTML = '<option value="" selected disabled>Pilih dosen penguji 2</option>';
        select3.innerHTML = '<option value="" selected disabled>Pilih dosen penguji 3</option>';
        select4.innerHTML = '<option value="" selected disabled>Pilih sekretaris</option>';

        // Get the selected option from select1
        var selectedOption1 = select1.options[select1.selectedIndex];

        // Clone the options from select1 to select2, excluding the selected option1
        for (var i = 0; i < select1.options.length; i++) {
            if (select1.options[i] !== selectedOption1) {
                var option2 = document.createElement("option");
                option2.value = select1.options[i].value;
                option2.text = select1.options[i].text;

                // Check if the option is already present in select2
                var isDuplicate = false;
                for (var j = 0; j < select2.options.length; j++) {
                    if (select2.options[j].value === option2.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select2 if not a duplicate
                if (!isDuplicate) {
                    select2.add(option2);
                }
            }
        }

        // Disable select3 and select4 if select2 is not selected
        select3.disabled = true;
        select4.disabled = true;

        // Get the selected option from select2
        var selectedOption2 = select2.options[select2.selectedIndex];

        // Clone the options from select2 to select3, excluding the selected option2
        for (var i = 0; i < select2.options.length; i++) {
            if (select2.options[i] !== selectedOption2) {
                var option3 = document.createElement("option");
                option3.value = select2.options[i].value;
                option3.text = select2.options[i].text;

                // Check if the option is already present in select3
                var isDuplicate = false;
                for (var j = 0; j < select3.options.length; j++) {
                    if (select3.options[j].value === option3.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select3 if not a duplicate
                if (!isDuplicate) {
                    select3.add(option3);
                }
            }
        }

        // Get the selected option from select3
        var selectedOption3 = select3.options[select3.selectedIndex];

        // Clone the options from select3 to select4, excluding the selected option3
        for (var i = 0; i < select3.options.length; i++) {
            if (select3.options[i] !== selectedOption3) {
                var option4 = document.createElement("option");
                option4.value = select3.options[i].value;
                option4.text = select3.options[i].text;

                // Check if the option is already present in select4
                var isDuplicate = false;
                for (var j = 0; j < select4.options.length; j++) {
                    if (select4.options[j].value === option4.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select4 if not a duplicate
                if (!isDuplicate) {
                    select4.add(option4);
                }
            }
        }

        // Enable select3 and select4 only if select2 and select3 are selected
        if (selectedOption2 && selectedOption3) {
            select3.disabled = false;
            select4.disabled = false;
        }
    }
</script>



<script>
    // function showConfirmation2() {
    //     Swal.fire({
    //         title: 'Apakah Anda yakin ingin submit data?',
    //         text: 'Pastikan data sudah benar sebelum submit.',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Sumbit!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Submit form only if "Ya" is clicked
    //             document.getElementById('submitForm').submit();
    //         }
    //     });
    // }

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

                // Validate dosen_penguji_3
                var dosenPenguji3 = document.getElementById('select3').value;
                if (!dosenPenguji3) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 3 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate sekretaris
                var sekretaris = document.getElementById('select4').value;
                if (!sekretaris) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Sekretaris harus dipilih.',
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
                        title: 'Success',
                        text: 'Data berhasil disubmit.',
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
                    title: 'Success',
                    text: 'Data berhasil dibuat.',
                    icon: 'success',
                }).then(() => {
                    // Submit form cetak
                    document.getElementById('cetakForm').submit();
                });
            }
        });
    }
</script>
