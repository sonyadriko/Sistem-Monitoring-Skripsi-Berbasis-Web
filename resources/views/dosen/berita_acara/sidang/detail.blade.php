@extends('layout.master')

@section('title')
Detail Berita Acara Sidang Skripsi
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
      <li class="breadcrumb-item active" aria-current="page">BA Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Sidang Skripsi</h5>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">NPM </label>
                            <p><span>{{ $data->kode_unik ?? 'error' }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">No. Ujian </label>
                            <p><span>{{ $data->id_berita_acara_s ?? 'error' }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Nama </label>
                            <p><span>{{ $data->name ?? 'error' }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Tanggal</label>
                            @php
                            $dateFromDatabase = $data->tanggal ?? 'error';
                            $formattedDate = date('d F Y', strtotime($dateFromDatabase));
                            @endphp
                            <p><span>{{ $formattedDate ?? 'error' }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Judul </label>
                            <p><span>{{ $data->judul ?? 'error' }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Ruang, Waktu </label>
                            <p><span>{{$data->nama_ruangan ?? 'error'}}, {{$data->jam ?? 'error'}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1 </label>
                            <p><span>{{ $data->dosen_pembimbing_utama ?? 'error' }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2</label>
                            <p><span>{{$data->dosen_pembimbing_ii ?? 'error'}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Penguji </label>
                            <p><span>{{$data->nama_penguji_1 ?? 'error'}} (Dosen Penguji 1)<br/>
                                {{$data->nama_penguji_2 ?? 'error'}} (Dosen Penguji 2)<br/>
                                {{$data->nama_penguji_3 ?? 'error'}} (Dosen Penguji 3)<br/>
                                {{$data->nama_sekretaris ?? 'error'}} (Sekretaris)</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        @if($detail && $detail->revisi)
        @else
        <div class="card mb-3">
            <h5 class="card-header">Review Dosen Pembimbing</h5>
            <form action="{{route('berita-acara-skripsi.store')}}" method="POST" id="reviewForm">
                @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="revisi" class="form-label">Revisi</label>
                    <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
                </div>
                @php
                $labels = ['Penulisan', 'Penyajian', 'Penguasaan Program', 'Penguasaan Materi', 'Penampilan'];
                @endphp

                @for($i = 0; $i < 5; $i++)
                    <div class="mb-3">
                        <label for="nilai_{{ $i+1 }}" class="form-label">Nilai {{ $labels[$i] }}</label>
                        <input type="number" class="form-control" name="nilai_{{ $i+1 }}" max="100" id="nilai_{{ $i+1 }}" placeholder="Masukkan Nilai {{ $labels[$i] }}..." aria-describedby="defaultFormControlHelp"/>

                        @error("nilai_".($i+1))
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endfor
                <input type="hidden" name="berita_acara_skripsi_id" value="{{$data->id_berita_acara_s}}"/>
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm();">Submit</button>
                </div>
            </div>
            </form>
        </div>
        @endif
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
    function submitForm() {
        // Validasi revisi dan nilai
        var revisi = document.getElementById('revisi').value;
        var nilai_1 = document.getElementById('nilai_1').value;
        var nilai_2 = document.getElementById('nilai_2').value;
        var nilai_3 = document.getElementById('nilai_3').value;
        var nilai_4 = document.getElementById('nilai_4').value;
        var nilai_5 = document.getElementById('nilai_5').value;

        nilai_1 = parseInt(nilai_1);
        nilai_2 = parseInt(nilai_2);
        nilai_3 = parseInt(nilai_3);
        nilai_4 = parseInt(nilai_4);
        nilai_5 = parseInt(nilai_5);


        if (!revisi.trim() || nilai_1 > 100 || nilai_2 > 100 || nilai_3 > 100 || nilai_4 > 100 || nilai_5 > 100 ) {
            Swal.fire({
                title: 'Error',
                text: 'Revisi dan nilai harus diisi dengan benar (nilai maksimal 100).',
                icon: 'error',
            });
        } else {
            showConfirmation();
        }
    }

    function showConfirmation() {
    Swal.fire({
        title: 'Konfirmasi Submit',
        text: 'Apakah Anda yakin ingin submit data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Submit!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Success',
                text: 'Data berhasil disubmit.',
                icon: 'success',
            }).then(() => {
                // Submit form
                document.getElementById('reviewForm').submit();
            }).then(() => {
                // Redirect to dashboard after successful submission
                // window.location.href = '/dashboard'; // Ganti dengan route dashboard yang sesuai
            });
        }
    });
}


</script>
