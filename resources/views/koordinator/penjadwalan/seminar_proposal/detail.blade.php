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
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bidang_ilmu" class="form-label">Judul yang diajukan</label>
                        <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                            <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
                        </div>
                        <div class="col-md-6">
                            <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                            <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">File Proposal</label>
                        {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
                        <p> <a href="{{ asset($data->file_proposal) }}" type="application/pdf" target="_blank">{{basename($data->file_proposal)}}</a>.</p>
                    </div>
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">File Slip Pembayaran</label>
                          {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
                          <p> <a href="{{ asset($data->file_slip_pembayaran) }}" type="application/pdf" target="_blank">{{basename($data->file_slip_pembayaran)}}</a>.</p>
                      </div>
                    <div class="mb-3">
                        <label for="select1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
                        <select class="form-select" id="select1" name="dosen_penguji_1" aria-label="Default select example" onchange="updateSelectOptions()">
                            <option value="" selected disabled>Open this select menu</option>
                            @foreach($baru as $datas)
                                @if($datas->id != $data->dosen_pembimbing_utama)
                                    <option value="{{$datas->id}}">{{$datas->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="select2" class="form-label">Dosen Penguji 2</label>
                    <select class="form-select" id="select2" name="dosen_penguji_2" aria-label="Default select example">
                        <option value="" selected disabled>Open this select menu</option>
                    </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="ruanganSeminar" class="form-label">Ruangan Seminar</label>
                        </div>
                        <div class="col">
                            <select class="form-control" id="ruanganSeminar" name="ruanganSeminar">
                                <option value="" disabled selected>Pilih Ruangan</option>
                                @foreach($listRuangan as $ruangan)
                                    <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="html5-date-input" class="form-label">Date</label>
                        </div>
                        <div class="col">
                            <input class="form-control" name="date" type="date" id="html5-date-input" />
                        </div>
                        <div class="col-md-2">
                            <label for="html5-time-input" class="form-label">Time</label>
                        </div>
                        <div class="col">
                            <input class="form-control" name="time" type="time" id="html5-time-input" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                        <div style="display: flex; justify-content: flex-end;">
                            {{-- <button type="submit" class="btn btn-primary" onclick="showConfirmation2();">Buat Jadwal</button> --}}
                            <button type="button" class="btn btn-primary" onclick="showConfirmation2();">Buat Jadwal</button>
                            {{-- <button type="submit" class="btn btn-primary" name="action" value="tolak">Tolak</button> --}}
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
            {{-- <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal])}}" method="POST"> --}}
            <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal]) }}" method="POST" id="cetakForm">
              @csrf
              <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="npm" class="form-label">NPM</label>
                    <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
                </div>
            </div>
            <div class="mb-3">
                <label for="bidang_ilmu" class="form-label">Judul yang diajukan</label>
                <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                    <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
                </div>
                <div class="col-md-6">
                    <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                    <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
                </div>
            </div>
              <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">File Proposal</label>
                  {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
                  <p> <a href="{{ asset($data->file_proposal) }}" type="application/pdf" target="_blank">{{basename($data->file_proposal)}}</a>.</p>
              </div>
              <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">File Slip Pembayaran</label>
                  {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
                  <p> <a href="{{ asset($data->file_slip_pembayaran) }}" type="application/pdf" target="_blank">{{basename($data->file_slip_pembayaran)}}</a>.</p>
              </div>
              <div class="mb-3 row">
                <div class="col-md-6">

                <label for="dosen_penguji_1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
                <input type="text" class="form-control" id="dosen_penguji_1" name="dosen_penguji_1" value="{{$data2->nama_penguji_1}}" readonly />
              </div>
              <div class="col-md-6">
                <label for="dosen_penguji_2" class="form-label">Dosen Penguji 2</label>
                <input type="text" class="form-control" id="dosen_penguji_2" name="dosen_penguji_2" value="{{$data2->nama_penguji_2}}" readonly />
              </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="ruanganSeminar" class="form-label">Ruangan Seminar</label>

                    <input type="text" class="form-control" name="ruanganSeminar" id="ruanganSeminar" value="{{$data2->nama_ruangan}}" placeholder="A-204" aria-describedby="ruanganSeminarHelp" readonly/>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    @php
                        $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                        $formatTanggal = ucfirst($carbonTanggal->formatLocalized('%A, %d %B %Y', strftime('%A')));
                    @endphp
                    <input class="form-control" name="date" type="text" value="{{$formatTanggal}}" readonly />
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label">Time</label>
                    @php
                        $carbonJam = \Carbon\Carbon::parse($data->jam);
                        $formatJam = $carbonJam->format('H:i');
                    @endphp
                    <input class="form-control" name="time" type="text" value="{{$formatJam}}" id="time" readonly />
                </div>
              </div>
              <input type="hidden" name="user_id" value="{{$data->users_id}}" />
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
  select2.innerHTML = '<option value="" selected disabled>Open this select menu</option>';

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
        confirmButtonText: 'Ya, Sumbit!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form only if "Ya" is clicked
            document.getElementById('submitForm').submit();
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
              document.getElementById('cetakForm').submit();
          }
      });
  }
  </script>
