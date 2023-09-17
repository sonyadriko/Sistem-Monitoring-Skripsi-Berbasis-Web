@extends('layouts/template')

@section('title')
Proposal
@endsection

<!-- Link ke CSS DataTables -->
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css"> --}}


{{-- <!-- Link ke JavaScript DataTables (termasuk jQuery) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script> --}}


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Table Daftar Mahasiswa Bimbingan Proposal</h5>
    
    <div class="card-body">
      <div class=" table-responsive  pt-0">
        <table class="table"/>
        {{-- <div class="table-responsive"> --}}
            {{-- <table class="table table-bordered id="dataTable" width="100%" cellspacing="0"> --}}
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        {{-- <th>Topik/Tema</th> --}}
                        <th>Action</th>
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach($bimbinganp as $dosen)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $dosen->name }}</td>
                        <td>{{ $dosen->topik_bidang_ilmu }}</td>
                        {{-- <td>{{ $dosen->topik_bidang_ilmu }}</td> --}}
                        <td><a href="{{ url('/dosen/bimbingan_proposal/detail/' . $dosen->id_bimbingan_proposal) }}" class="btn btn-primary">Detail</a></td>
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
    {{-- <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form id="updateStatusForm" method="POST">
                @csrf

                <input type="hidden" id="val_id" name="val_id"/>
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" id="nama" class="form-control" placeholder="Enter Name" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                  <label for="npm" class="form-label">npm</label>
                  <input type="text" id="npm"  class="form-control" placeholder="xxxx@xxx.xx"/>
                </div>
                <div class="col mb-3">
                  <label for="bidangilmu" class="form-label">Bidang Ilmu</label>
                  <input
                    type="text"
                    id="bidangilmu"
                    class="form-control"
                    placeholder="DD / MM / YY"
                  />
                </div>
              </div>
                <div class="row">
                    <div class="col mb-3">
                      <label for="matakuliahpilihan" class="form-label">Matakuliah Pilihan</label>
                      <input
                        type="text"
                        id="matakuliahpilihan"
                        class="form-control"
                        placeholder="Enter Matakuliah Pilihan"
                      />
                    </div>
                  </div>
                  <!-- Tambahkan data judul -->
                  <div class="row">
                    <div class="col mb-3">
                      <label for="judul" class="form-label">Judul</label>
                      <input
                        type="text"
                        id="judul"
                        class="form-control"
                        placeholder="Enter Judul"
                      />
                    </div>
                  </div>
                  <!-- Tambahkan data status -->
                  <div class="row">
                    <div class="col mb-3">
                      <label for="status" class="form-label">Status</label>
                      <input
                        type="text"
                        id="status"
                        class="form-control"
                        placeholder="Enter Status"
                        readonly
                      />
                    </div>
                  </div>
              
            </div>
            <input type="hidden" name="status" value="acc"/>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                  </button>
                  <button type="submit" id="btnacc" class="btn btn-success" data-status="acc">Acc</button>

            </div>
            </form>
          </div>
        </div>
      </div> --}}
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
  $('#dataTable').DataTable({
    paging: true,
    searching: true,
    ordering: true,
    // Opsi lainnya
  });
});
  </script>


  {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    $('#modalCenter').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang di-klik
        var itemId = button.data('item-id'); // Ambil data ID dari tombol

        // Ambil data dari server menggunakan AJAX
        $.ajax({
            url: '{{url('/koordinator/pengajuan_judul/getdetail')}}'+"/"+itemId, // URL dari route yang menangani request ini
            method: 'GET',
            success: function(data) {
                // Isi input dengan data yang diambil
                $('#nama').val(data.nama);
                $('#npm').val(data.npm);
                $('#bidangilmu').val(data.bidang_ilmu);
                $('#matakuliahpilihan').val(data.mk_pilihan);
                $('#judul').val(data.judul);
                $('#status').val(data.status);

            }
        }); 
    //     $('#btnacc').on('click',function(e) {
    //         e.preventDefault(); // Mencegah form submit bawaan
    //     var itemId = button.data('item-id'); // Ambil
    //     $.ajax({
    //       url: '{{ url('/koordinator/updatedetail') }}'+"/"+itemId, // Ganti dengan URL endpoint yang sesuai di server Anda
    //       method: 'POST',

    //     //   data: $(this).serialize(), // Mengambil data formulir
    //       success: function(response) {
    //         // Tanggapan dari server (jika ada)
    //         console.log('Status berhasil diperbarui: ' + response);

    //         // Perbarui tampilan status pada modal
    //         location.reload();
    //       },
    //       error: function(xhr, status, error) {
    //         // Penanganan kesalahan jika ada
    //         console.error('Terjadi kesalahan: ' + error);
    //       }
    //     });

    // });
        
    });
});

    </script>

{{--   
<script>
    $(document).ready(function () {
        $('#accbutton').click(function () {
            var temaId = $(this).data('tema-id');

            $.ajax({
              
                method: 'POST',
                url: '{{ url('/koordinator/pengajuan_judul/updatedetail') }}'+"/"+temaId, 
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success: function (response) {
                    // Proses respons atau lakukan apa pun yang diperlukan
                    alert(response.message);
                },
                error: function (error) {
                    // Handle error
                    alert('Error: ' + error.responseJSON.message);
                }
            });
        });
    });
</script> --}}