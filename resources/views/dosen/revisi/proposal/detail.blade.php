@extends('layout.master')

@section('title')
Detail Revisi Seminar Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Bimbingan & Revisi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Revisi Seminar Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card mb-4">
            <h5 class="card-header">Revisi Seminar Proposal</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">NPM </label>
                            <input type="text" class="form-control" value="{{ $data->kode_unik }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Nama </label>
                            <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Bidang Ilmu </label>
                            <input type="text" class="form-control" value="{{$data->topik_bidang_ilmu}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Dosen Pembimbing Utama </label>
                            <input type="text" class="form-control" value="{{ $data->dosen_pembimbing_utama }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Nama </label>
                            <input type="text" class="form-control" value="{{ $data->dosen_pembimbing_ii }}" readonly>
                        </div>
                    </div>
                    <input type="hidden" value="{{$revisi->id_detail_berita_acara_p}}"/>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="mb-3">
        <div class="card mb-4 mb-xl-0">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>File</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($detail as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <a href="{{ asset($item->file_revisi) }}" class="btn btn-primary" target="_blank">Cek File</a>
                            </td>
                            {{-- <td>
                                <button type="button" class="btn btn-primary"
                                    onclick="prepareModal({{ $item->id_revisi_seminar_proposal }})">
                                    Tambahkan Revisi
                                </button>
                            </td> --}}
                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary justify-content-end mb-4" onclick="prepareModal({{ $revisi->id_detail_berita_acara_p }})">
    Tambahkan Revisi
</button>
<div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Revisi Proposal</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="revisiForm">
                    @csrf
                    <input type="hidden" id="idBeritaAcara" name="id_berita_acara_p">
                    <div class="form-group">
                        <label for="revisiInput">Revisi:</label>
                        <textarea class="form-control" id="revisiInput" name="revisi"
                            rows="4" cols="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Revisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="successAlert" class="alert alert-success" style="display: none;">
    Revisi berhasil dikirim! <button id="okButton" class="btn btn-primary">OK</button>
</div>
<div class="row">
    <div class="mb-3">
        <div class="card mb-4">
            <h5 class="card-header">Persetujuan Revisi Seminar Proposal</h5>
            <div class="card-body">
                <span class="span0-1">Persetujuan Revisi </span>
                <input type="hidden" id="dospem" value="{{$data->dosen_pembimbing_utama}}">
                <input type="hidden" id="penguji1" value="{{$data->nama_penguji_1}}">
                <input type="hidden" id="penguji2" value="{{$data->nama_penguji_2}}">
                @if (Auth::user()->name == $data->nama_penguji_1)
                    @if ($data->acc_penguji_1 == null)
                        <button type="button" id="penguji1" value="{{ $data->nama_penguji_1 }}" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_berita_acara_p }}')">
                            Setujui Revisi
                        </button>
                    @else
                        <span class="span0-1">Sudah di acc oleh dosen pada {{$data->tgl_acc_penguji_1}} </span>
                    @endif
                @elseif (Auth::user()->name == $data->nama_penguji_2)
                    @if ($data->acc_penguji_2 == null)
                        <button type="button" id="penguji2" value="{{ $data->nama_penguji_2 }}" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_berita_acara_p }}')">
                            Setujui Revisi
                        </button>
                    @else
                        <span class="span0-1">Sudah di acc oleh dosen pada {{$data->tgl_acc_penguji_2}} </span>
                    @endif
                @elseif (Auth::user()->name == $data->dosen_pembimbing_utama)
                    @if ($data->acc_dospem == null)
                        <button type="button" id="dospem" value="{{ $data->dosen_pembimbing_utama }}" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_berita_acara_p }}')">
                            Setujui Revisi
                        </button>
                    @else
                        <span class="span0-1">Sudah di acc oleh dosen pada {{$data->tgl_acc_dospem}} </span>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function prepareModal(idBeritaAcara) {
        // Reset nilai textarea
        document.getElementById('revisiInput').value = '';

        // Mengisi nilai id bimbingan proposal
        document.getElementById('idBeritaAcara').value = idBeritaAcara;

        // Tampilkan modal
        $('#revisiModal').modal('show');
    }
</script>

<script>
    $(document).ready(function () {
        // Function to prepare the modal
        function prepareModal(id) {
            $('#idBeritaAcara').val(id);
            $('#revisiModal').modal('show');
        }

        // Function to handle form submission
        $('#revisiForm').submit(function (e) {
            e.preventDefault();

            // Perform AJAX submission
            $.ajax({
                type: 'POST',
                url: '{{ route("dosen-revisi-add.detail", $revisi->id_detail_berita_acara_p) }}',
                data: $('#revisiForm').serialize(),
                success: function (response) {
                    // Hide the modal
                    $('#revisiModal').modal('hide');

                    // Display success message
                    $('#successAlert').show();

                    // Optionally, you can redirect or perform other actions after a successful submission
                    Example: window.location.href = '{{ route("dosen-revisi-sempro.index") }}';
                },
                error: function (error) {
                    console.error('Error submitting form:', error);
                    // Handle error if needed
                }
            });
        });

        // Function to handle OK button click
        $('#okButton').click(function () {
            // Hide the success alert
            $('#successAlert').hide();
        });
    });
</script>


<script>

    // Pastikan dokumen telah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen 'revisiForm' jika ada
        var revisiForm = document.getElementById('revisiForm');

        // Periksa apakah elemen 'revisiForm' ditemukan
        if (revisiForm) {
            // Tambahkan event listener untuk saat form di-submit
            revisiForm.addEventListener('submit', function(event) {
                event.preventDefault();

                var revisiInput = document.getElementById("revisiInput").value;
                var idBeritaAcara = document.getElementById('idBeritaAcara').value;

                console.log('Revisi yang dikirim:', revisiInput);
                console.log('ID Berita Acara:', idBeritaAcara);

                axios.post(`/dosen/revisi_seminar_proposal/addrevisi/${idBeritaAcara}`, {
                    revisi: revisiInput
                })
                .then(function (response) {
                    console.log('Respon dari server:', response.data);
                    $('#revisiModal').modal('hide'); // Tutup modal setelah berhasil submit

                    Swal.fire({
                        title: 'Revisi berhasil dikirim!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lakukan refresh halaman
                            location.reload();
                        }
                    });
                })
                .catch(function (error) {
                    console.error("Terjadi kesalahan: " + error);
                });
            });
        } else {
            console.error("Elemen 'revisiForm' tidak ditemukan.");
        }
    });

        function confirmAccProposal(idBeritaAcara) {

        const dospemElement = document.getElementById('dospem');
        const penguji1Element = document.getElementById('penguji1');
        const penguji2Element = document.getElementById('penguji2');

        // Check if elements are found before accessing their values
        if (dospemElement && penguji1Element && penguji2Element) {
            dospem = dospemElement.value;
            penguji1 = penguji1Element.value;
            penguji2 = penguji2Element.value;

            // Log the values to the console
            console.log('dospem:', dospem);
            console.log('penguji1:', penguji1);
            console.log('penguji2:', penguji2);

            Swal.fire({
                title: 'Apakah Anda yakin ingin acc revisi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    accProposal(idBeritaAcara, dospem, penguji1, penguji2);
                }
            });
        } else {
            console.error('Error: One or more elements not found.');
        }
    }

        function accProposal(idBeritaAcara, dospem, penguji1, penguji2) {
            const data = {
                dospem: dospem,
                penguji1: penguji1,
                penguji2: penguji2
            };
            axios.post(`/dosen/revisi_seminar_proposal/accrevisi/${idBeritaAcara}`, data)
                .then(function (response) {
                    console.log('Response from the server:', response.data);

                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Revisi Proposal berhasil diacc!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();  // Reload the page
                        }
                    });
                })
                .catch(function (error) {
                    // Handle JSON response failure
                    console.error('Terjadi kesalahan:', error);
                    if (error.response && error.response.data) {
                        // If the response contains error message
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            text: error.response.data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // If the response does not contain error message
                        Swal.fire({
                            title: 'Terjadi kesalahan',
                            text: 'Gagal memproses permintaan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
        }
</script>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush



