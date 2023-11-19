@extends('layouts/template')

@section('title')
Detail Pengajuan Sidang Skripsi
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Penjadwalan Sidang Skripsi</h5>
        @if (is_null($data)||is_null($data->dosen_penguji_1)||is_null($data->dosen_penguji_2))
        <div class="card-body">
            <form action="{{ route('jadwal-sidang-skripsi-update', ['id' => $data->id_sidang_skripsi]) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="bidangIlmu" class="form-label">Judul yang diajukan</label>
                <input type="text" class="form-control" id="bidangIlmu" name="bidangIlmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospemUtama" class="form-label">Dosen Pembimbing 1</label>
                <input type="text" class="form-control" id="dospemUtama" name="dospemUtama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                <input type="text" class="form-control" name="dospem2" id="dospem2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
            <div class="mb-3">
              <label for="fileSkripsi" class="form-label">File Skripsi</label>
              {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
              <p> <a href="{{ asset($data->file_skripsi) }}" type="application/pdf" target="_blank">Cek File</a>.</p>

            </div>
            <div class="mb-3">
              <label for="select1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
              <select class="form-select" id="select1" name="dosenPenguji1" aria-label="Default select example" onchange="updateSelectOptions()">
                <option value="" selected disabled>Open this select menu</option>

                  @foreach($baru as $datas)
                      <option value="{{$datas->id}}">{{$datas->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="select2" class="form-label">Dosen Penguji 2</label>
              <select class="form-select" id="select2" name="dosenPenguji2" aria-label="Default select example">
                <option value="" selected disabled>Open this select menu</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="select3" class="form-label">Dosen Penguji 3</label>
                <select class="form-select" id="select3" name="dosenPenguji3" aria-label="Default select example">
                    <option value="" selected disabled>Open this select menu</option>
                    <!-- Options for Dosen Penguji 3 go here -->
                </select>
            </div>
            <div class="mb-3">
                <label for="select3" class="form-label">Sekretaris</label>
                <select class="form-select" id="select3" name="sekretaris" aria-label="Default select example">
                    <option value="" selected disabled>Open this select menu</option>
                    <!-- Options for Dosen Penguji 3 go here -->
                </select>
            </div>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="ruanganSeminar" class="form-label">Ruangan Sidang</label>
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
                <input class="form-control" name="date" type="date" value="2021-06-18" id="html5-date-input" />
              </div>

              <div class="col-md-2">
                <label for="html5-time-input" class="form-label">Time</label>
              </div>
              <div class="col">
                <input class="form-control" name="time" type="time" value="12:30:00" id="html5-time-input" />
              </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
      @else
      <div class="card-body">
        {{-- <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal])}}" method="POST"> --}}
        <form action="{{ route('cetak-berita-acara-s', ['id' => $data->id_sidang_skripsi]) }}" method="POST" id="cetakForm">
          @csrf
          <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Mahasiswa</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="bidangIlmu" class="form-label">Judul yang diajukan</label>
            <input type="text" class="form-control" id="bidangIlmu" name="bidangIlmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="dospemUtama" class="form-label">Dosen Pembimbing 1</label>
            <input type="text" class="form-control" id="dospemUtama" name="dospemUtama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
            <input type="text" class="form-control" name="dospem2" id="dospem2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">File Proposal</label>
              {{-- <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe> --}}
              <p> <a href="{{ asset($data->file_skripsi) }}" type="application/pdf" target="_blank">Cek File</a>.</p>

          </div>
          <div class="mb-3">
            <label for="dosenPenguji1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
            <input type="text" class="form-control" id="dosenPenguji1" name="dosenPenguji1" value="{{$data->dosen_penguji_1}}" readonly />
          </div>
          <div class="mb-3">
            <label for="dosenPenguji2" class="form-label">Dosen Penguji 2</label>
            <input type="text" class="form-control" id="dosenPenguji2" name="dosenPenguji2" value="{{$data->dosen_penguji_2}}" readonly />
          </div>
          <div class="mb-3">
            <label for="dosenPenguji3" class="form-label">Dosen Penguji 3</label>
            <input type="text" class="form-control" id="dosenPenguji3" name="dosenPenguji3" value="{{$data->dosen_penguji_3}}" readonly />
          </div>
          <div class="mb-3">
            <label for="sekretaris" class="form-label">Sekretaris</label>
            <input type="text" class="form-control" id="sekretaris" name="sekretaris" value="{{$data->sekretaris}}" readonly />
          </div>
          <div class="row mb-3">
            <div class="col-md-2">
              <label for="ruanganSeminar" class="form-label">Ruangan Seminar</label>
            </div>
            <div class="col">
              <input type="text" class="form-control" name="ruanganSeminar" id="ruanganSeminar" value="{{$data->nama_ruangan}}" placeholder="A-204" aria-describedby="ruanganSeminarHelp" readonly/>
            </div>
            <div class="col-md-2">
              <label for="html5-date-input" class="form-label">Date</label>
            </div>
            <div class="col">
              <input class="form-control" name="date" type="date" value="{{$data->tanggal}}" id="html5-date-input" readonly/>
            </div>

            <div class="col-md-2">
              <label for="html5-time-input" class="form-label">Time</label>
            </div>
            <div class="col">
              <input class="form-control" name="time" type="time" value="{{$data->jam}}" id="html5-time-input" readonly />
            </div>
          </div>
          <input type="hidden" name="user_id" value="{{$data->users_id}}" />
          <input type="hidden" name="sidang_skripsi_id" value="{{$data->id_sidang_skripsi}}" />

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


@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    function updateSelectOptions() {
      var select1 = document.getElementById("select1");
      var select2 = document.getElementById("select2");
      var select3 = document.getElementById("select3");

      // Clear existing options in select2 and select3
      select2.innerHTML = '<option value="" selected disabled>Open this select menu</option>';
      select3.innerHTML = '<option value="" selected disabled>Open this select menu</option>';

      // Get the selected option from select1
      var selectedOption = select1.options[select1.selectedIndex];

      // Clone the options from select1 to select2 and select3, excluding the selected option
      for (var i = 0; i < select1.options.length; i++) {
          if (select1.options[i] !== selectedOption) {
              var option2 = document.createElement("option");
              option2.value = select1.options[i].value;
              option2.text = select1.options[i].text;
              select2.add(option2);

              var option3 = document.createElement("option");
              option3.value = select1.options[i].value;
              option3.text = select1.options[i].text;
              select3.add(option3);
          }
      }
    }
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
