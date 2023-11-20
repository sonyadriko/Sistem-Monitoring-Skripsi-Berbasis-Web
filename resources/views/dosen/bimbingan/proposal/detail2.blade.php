@extends('layouts/template')

 @section('title')
 Bimbingan Proposal
 @endsection

 <link rel="stylesheet" href="{{ asset('/css/custom.css') }}" />

 @section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
     <div class="card mb-4">
         <h5 class="card-header">Form Bimbingan Proposal</h5>
         <div class="card-body">
             <p >
                 <span class="span0-1">NPM :</span>
                 <span class="span1-1">{{ $data->kode_unik }}<br /></span>
                 <span class="span0-1">Nama :</span>
                 <span class="span1-1">{{ $data->name }}<br /></span>
                 <span class="span0-1">Tema :</span>
                 <span class="span1-1">{{ $data->topik_bidang_ilmu }}<br /></span>
                 <span class="span0-1">Dosen Pembimbing Utama :</span>
                 {{-- <span class="span1-1">{{ $data->dosen_pembimbing_utama }}<br /></span> --}}
                 <input
                    class="form-control input-like-span"
                    type="text"
                    id="dospem1"
                    name="dospem1"
                    value="{{ $data->dosen_pembimbing_utama }}"
                    readonly
                    autocomplete="off"
                /><br/>
                 <span class="span0-1">Dosen Pembimbing II :</span>
                 {{-- <span class="span1-1">{{ $data->dosen_pembimbing_ii }}<br /></span> --}}
                 <input
                    class="form-control input-like-span"
                    type="text"
                    id="dospem2"
                    name="dospem2"
                    value="{{ $data->dosen_pembimbing_ii }}"
                    readonly
                    autocomplete="off"
                /><br/>
             </p>
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
                                 <th>Revisi Dosen</th>
                                 <th>File</th>
                                 <th>Validasi Revisi</th>
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
                                 <td>{{ $item->revisi }}</td>
                                 <td>
                                     <a href="{{ asset($item->file) }}" class="btn btn-primary" target="_blank">Cek File</a>
                                 </td>
                                 <td>{{ $item->validasi }}</td>
                                 <td>
                                     <button type="button" class="btn btn-primary"
                                         onclick="prepareModal({{ $item->id_detail_bimbingan_proposal }})">
                                         Tambahkan Revisi
                                     </button>
                                     <button type="button" class="btn btn-primary" onclick="confirmAccRevisi({{ $item->id_detail_bimbingan_proposal }})">
                                        Acc Revisi
                                    </button>

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

            <div class="card-body">
                <span class="span0-1">Proposal Acceptance </span>
                @if ($data->acc_dosen_utama == null && $data->acc_dosen_ii == null)
                    @if (Auth::user()->name == $data->dosen_pembimbing_utama)
                    <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                    Accept Proposal
                    </button>
                    @elseif (Auth::user()->name == $data->dosen_pembimbing_ii)
                    <button type="button" id="accProposalBtn" class="btn btn-primary accept-button" onclick="confirmAccProposal('{{ $data->id_bimbingan_proposal }}')">
                        Accept Proposal2
                    </button>
                    @endif
                @else
                <span class="span0-1">Sudah di acc oleh dosen pada {{$data->tgl_acc_dosen_utama}} </span>
                @endif
            </div>
        </div>
    </div>
 </div>
 @endsection

 <!-- ... HTML lainnya ... -->

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


    function confirmAccRevisi(idDetailBimbinganProposal) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin acc revisi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {

                accRevisi(idDetailBimbinganProposal);
            }
        });
    }

    function accRevisi(idDetailBimbinganProposal) {
        // Lakukan update data ke server menggunakan AJAX
        axios.post(`/dosen/bimbingan_proposal/accrevisi/${idDetailBimbinganProposal}`)
            .then(function (response) {
                console.log('Respon dari server:', response.data);

                // Tampilkan pesan sukses menggunakan SweetAlert
                Swal.fire({
                    title: 'Revisi berhasil diacc!',
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
    }


    function confirmAccProposal(idBimbinganProposal) {
    const dospem1 = document.getElementById('dospem1').value;
    const dospem2 = document.getElementById('dospem2').value;

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
