@extends('layout.master')

@section('title')
Seminar Proposal
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
            <h5 class="card-header">Penjadwalan Seminar Proposal</h5>
            @if (is_null($data)||is_null($data->dosen_penguji_1)||is_null($data->dosen_penguji_2))
            <div class="card-body">
                <form action="{{ route('jadwal-seminar-proposal-update', ['id' => $data->id_seminar_proposal]) }}" method="POST" id="submitForm">
                  @csrf
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
                            <label for="npm" class="form-label"style="font-weight: bold" >Judul</label>
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
                    <div class="mb-3">
                        <label for="select1" class="form-label" style="font-weight: bold">Ketua Seminar/Dosen Penguji 1</label>
                        <select class="form-select @error('dosen_penguji_1') is-invalid @enderror" id="select1" name="dosen_penguji_1" aria-label="Default select example" onchange="updateSelectOptions()">
                            <option value="" selected disabled>Pilih dosen penguji 1</option>
                            @foreach($baru as $datas)
                                @if($datas->id != $data->dosen_pembimbing_utama)
                                    <option value="{{$datas->id}}">{{$datas->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('dosen_penguji_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="select2" class="form-label" style="font-weight: bold">Dosen Penguji 2</label>
                        <select class="form-select @error('dosen_penguji_2') is-invalid @enderror" id="select2" name="dosen_penguji_2" aria-label="Default select example">
                            <option value="" selected disabled>Pilih dosen penguji 2</option>
                        </select>
                        @error('dosen_penguji_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan Seminar</label>

                            <select class="form-control @error('ruanganSeminar') is-invalid @enderror" id="ruanganSeminar" name="ruanganSeminar">
                                <option value="" disabled selected>Pilih Ruangan</option>
                                @foreach($listRuangan as $ruangan)
                                    <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            @error('ruanganSeminar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="html5-date-input" class="form-label" style="font-weight: bold">Date</label>
                            <input class="form-control @error('date') is-invalid @enderror" name="date" type="date" id="html5-date-input" />
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="html5-time-input" class="form-label" style="font-weight: bold">Time</label>
                            <input class="form-control @error('time') is-invalid @enderror" name="time" type="time" id="html5-time-input" />
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="button" class="btn btn-primary" onclick="showConfirmation2();">Buat Jadwal</button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('jadwal-seminar-proposal-tolak', ['id' => $data->id_seminar_proposal]) }}" method="POST">
                    @csrf
                    <!-- ... form fields ... -->
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn btn-danger" name="action" value="tolak">Tolak</button>
                    </div>
                </form>
            </div>
          @else
          <div class="card-body">
            <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal]) }}" method="POST" id="cetakForm">
              @csrf
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
                <p><span>{{ $data2->nama_penguji_1 }}</span></p>
                {{-- <input type="text" class="form-control" id="dosen_penguji_1" name="dosen_penguji_1" value="{{$data2->nama_penguji_1}}" readonly /> --}}
              </div>
              <div class="col-md-6">
                <label for="dosen_penguji_2" class="form-label" style="font-weight: bold">Dosen Penguji 2</label>
                <p><span>{{ $data2->nama_penguji_2 }}</span></p>
                {{-- <input type="text" class="form-control" id="dosen_penguji_2" name="dosen_penguji_2" value="{{$data2->nama_penguji_2}}" readonly /> --}}
              </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan Seminar</label>
                  <p><span>{{ $data2->nama_ruangan }}</span></p>
                    {{-- <input type="text" class="form-control" name="ruanganSeminar" id="ruanganSeminar" value="{{$data2->nama_ruangan}}" placeholder="A-204" aria-describedby="ruanganSeminarHelp" readonly/> --}}
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label" style="font-weight: bold">Date</label>
                    @php
                        $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                        $formatTanggal = ucfirst($carbonTanggal->formatLocalized('%A, %d %B %Y', strftime('%A')));
                    @endphp
                    <p><span>{{ $formatTanggal }}</span></p>
                    {{-- <input class="form-control" name="date" type="text" value="{{$formatTanggal}}" readonly /> --}}
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label" style="font-weight: bold">Time</label>
                    @php
                        $carbonJam = \Carbon\Carbon::parse($data->jam);
                        $formatJam = $carbonJam->format('H:i');
                    @endphp
                    <p><span>{{ $formatJam }}</span></p>
                    {{-- <input class="form-control" name="time" type="text" value="{{$formatJam}}" id="time" readonly /> --}}
                </div>
              </div>
              <input type="hidden" name="users_id" value="{{$data2->users_id}}" />
              <input type="hidden" name="seminar_proposal_id" value="{{$data->id_seminar_proposal}}" />

              <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                @if(is_null($data)|| is_null($data->cetak))
                <button type="button" class="btn btn-primary" onclick="showConfirmation()">Cetak</button>
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
                text: 'Data berhasil dicetak.',
                icon: 'success',
            }).then(() => {
                // Submit form cetak
                document.getElementById('cetakForm').submit();
            });
        }
    });
}

  </script>
