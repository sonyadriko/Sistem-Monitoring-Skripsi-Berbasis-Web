@extends('layout.master')

@section('title')
Detail Bimbingan Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="row">
    <h4>Status Bimbingan Proposal</h4>
    <p class="mb-2">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini.</p>
    <div class="col-md-12 stretch-card">
        <div class="card mb-4">
            <h5 class="card-header">Data Mahasiswa dan Dosen Pembimbing</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">NPM </label>
                            <p><span>{{ $data->kode_unik }}</span></p>
                            {{-- <input type="text" class="form-control" value="{{ $data->kode_unik }}" readonly> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Nama </label>
                            <p><span>{{ $data->name }}</span></p>
                            {{-- <input type="text" class="form-control" value="{{ $data->name }}" readonly> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Judul </label>
                            <p><span>{{ $data->judul }}</span></p>
                            {{-- <input type="text" class="form-control" value="{{$data->judul}}" readonly> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Bidang Ilmu </label>
                            <p><span>{{ $data->topik_bidang_ilmu }}</span></p>
                            {{-- <input type="text" class="form-control" value="{{$data->topik_bidang_ilmu}}" readonly> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing Utama </label>
                            <p><span>{{ $data->dosen_pembimbing_utama }}</span></p>

                            {{-- <input type="text" class="form-control" value="{{ $data->dosen_pembimbing_utama }}" readonly> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing ii </label>
                            <p><span>{{ $data->dosen_pembimbing_ii }}</span></p>

                            {{-- <input type="text" class="form-control" value="{{ $data->dosen_pembimbing_ii }}" readonly> --}}
                        </div>
                    </div>
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
                            <th>Bimbingan</th>
                            {{-- <th>Revisi Dosen</th> --}}
                            <th>File</th>
                            {{-- <th>Validasi Revisi</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($detail as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $no }}</td>
                            <td>
                                <a href="{{ asset($item->file) }}" class="btn btn-primary" target="_blank">Cek File</a>
                            </td>
                            {{-- <td>{{ $item->validasi }}</td> --}}
                            <td>

                                <button type="button" class="btn btn-primary" onclick="prepareModal({{ $item->id_detail_bimbingan_proposal }})">
                                    Tambahkan Revisi
                                </button>
                                    {{-- <button type="button" class="btn btn-primary" onclick="confirmAccRevisi({{ $item->id_detail_bimbingan_proposal }})">
                                        Acc Revisi
                                    </button> --}}

                            </td>

                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach

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
                                            <input type="hidden" id="idBimbinganProposal" name="id_bimbingan_proposal">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="card mb-4">
        <h5 class="card-header">Persetujuan Seminar Proposal</h5>
        <div class="card-body">
            <span class="span0-1">Persetujuan Seminar </span>
            {{-- @if ($data->acc_dosen_utama == null && $data->acc_dosen_ii == null)

                @if (Auth::user()->name == $data->dosen_pembimbing_utama)
                <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                Setujui Proposal
                </button>
                @elseif (Auth::user()->name == $data->dosen_pembimbing_ii)
                <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                Setujui Proposal
                </button>
                @endif
            @else
            <span class="span0-1">Sudah di acc oleh dosen pada {{$data->tgl_acc_dosen_utama}} </span>
            @endif --}}
            <input type="hidden" id="dospem1" value="{{$data->dosen_pembimbing_utama}}">
            <input type="hidden" id="dospem2" value="{{$data->dosen_pembimbing_ii}}">
            @if (Auth::user()->name == $data->dosen_pembimbing_utama)
                @if ($data->acc_dosen_utama == null)
                    <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                        Setujui Proposal
                    </button>
                @else
                    <span class="span0-1">Sudah di acc oleh dosen pembimbing utama pada {{$data->tgl_acc_dosen_utama}} </span>
                @endif
            @elseif (Auth::user()->name == $data->dosen_pembimbing_ii)
                @if ($data->acc_dosen_ii == null)
                    <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                        Setujui Proposal
                    </button>
                @else
                    <span class="span0-1">Sudah di acc oleh dosen pembimbing ii pada {{$data->tgl_acc_dosen_ii}} </span>
                @endif
            @endif


        </div>
    </div>
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
   function prepareModal(idBimbinganProposal) {
       // Reset nilai textarea
       document.getElementById('revisiInput').value = '';

       // Mengisi nilai id bimbingan proposal
       document.getElementById('idBimbinganProposal').value = idBimbinganProposal;

       // Tampilkan modal
       $('#revisiModal').modal('show');
   }
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
               var idBimbinganProposal = document.getElementById('idBimbinganProposal').value;

               console.log('Revisi yang dikirim:', revisiInput);
               console.log('ID Bimbingan Proposal:', idBimbinganProposal);

               axios.post(`/dosen/bimbingan_proposal/updaterevisi/${idBimbinganProposal}`, {
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


   function confirmAccProposal(idBimbinganProposal) {
    var dospem1Element = document.getElementById('dospem1');
    var dospem2Element = document.getElementById('dospem2');

    // Check if the elements exist before accessing their values
    if (dospem1Element && dospem2Element) {
        const dospem1 = dospem1Element.value;
        const dospem2 = dospem2Element.value;

        Swal.fire({
            title: 'Apakah Anda yakin ingin acc proposal ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                accProposal(idBimbinganProposal, dospem1, dospem2);
            }
        });
    } else {
        console.error("Elemen 'dospem1' or 'dospem2' not found.");
    }
}


function accProposal(idBimbinganProposal, dospem1, dospem2) {
   const data = {
       dospem1: dospem1,
       dospem2: dospem2
   };

   axios.post(`/dosen/bimbingan_proposal/accproposal/${idBimbinganProposal}`, data)
       .then(function (response) {
           console.log('Response from the server:', response.data);

           // Show success message using SweetAlert
           Swal.fire({
               title: 'Proposal berhasil diacc!',
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
