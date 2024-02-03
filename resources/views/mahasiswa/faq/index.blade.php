@extends('layout.master')

@section('title')
Info Penting
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Info Penting</h4>
    </div>
</div>
<h6 class="mb-4">Informasi penting dapat anda cari pada halaman ini.</h6>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Pertanyaan yang Sering Diajukan</h6>
          <div class="accordion" id="FaqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Bagaimana alur yang harus dilalui untuk melakukan pengajuan judul proposal skripsi?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Pengajuan judul <strong>Proposal Skripsi </strong> dimulai dengan memilih <strong>Bidang ilmu  </strong> sesuai dengan yang sudah disediakan, lalu dilanjutkan dengan mengisi <strong>Form pengajuan </strong> tema/judul skripsi dan menunggu persetujuan dari <strong>Koordinator </strong> mengenai judul yang diajukan serta pembagian <strong>Dosen Pembimbing  </strong> yang sesuai dengan bidang ilmu yang diambil untuk dilanjutkan ke proses Bimbingan Proposal skripsi. Setelah proses pembimbingan selesai dilakukan, mahasiswa dapat melakukan pendaftaran <strong>Sidang Proposal Skripsi.  </strong> Pengajuan sidang yang dilakukan akan diproses oleh Koordinator untuk dibuatkan <strong>Jadwal Sidang Proposal,  </strong> lalu setelah Sidang Proposal dilaksanakan mahasiswa perlu mengerjakan revisi dari <strong>Dosen Penguji.  </strong> Barulah mahasiswa dapat mengajukan <strong>Surat Tugas   </strong> untuk dibuatkan sebagai bukti  <strong>Bimbingan Laporan Skripsi   </strong> dengan Dosen Pembimbing. Setelah Bimbingan Laporan Skripsi dilakukan minimal sebanyak 12 kali pertemuan, mahasiswa dapat melakukan pendaftaran   <strong>Sidang Skripsi </strong>serta mengerjakan revisi berdasarkan dari Sidang yang dilakukan.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Berapa lama jangka waktu berlakunya topik skripsi yang masih dapat disidangkan?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Jangka waktu berlaku Topik Skripsi adalah 2 kali 6 bulan sejak Surat Tugas dikeluarkan.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Apa yang harus dipersiapkan untuk melakukan pendaftaran Sidang Proposal, Sidang Skripsi, Surat survey atau Surat Tugas?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Persiapan pendaftaran Sidang Proposal, Sidang Skripsi, Surat Tugas memerlukan: <br>
                    1.	File Proposal Skripsi/Laporan Skripsi yang sudah di ACC dosen pembimbing <br>
                    2.	File Slip bukti pembayaran Sidang yang sudah dibayarkan di loke pembayaran kampus <br>
                    Persiapan pendaftaran Surat Survey: <br>
                    1.	Tempat survey <br>
                    2.	Lama Durasi survey <br>

                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Berapa jumlah nominal yang harus dibayarkan pada setiap pendaftaran Sidang Proposal, Pengajuan Surat Tugas, Pendaftaran Sidang Skiripsi, dll?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Jumlah yang harus dibayarkan setiap pendaftaran: <br>
                    •	Pendaftaran Seminar Proposal	: Rp. 160.000 <br>
                    •	Pengajuan Surat Tugas	: Rp. 450.000 <br>
                    •	Pendaftaran Sidang Skripsi	: Rp. 675.000 <br>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Berapa jumlah minimal halaman untuk sebuah Proposal Skripsi dan Laporan Skripsi?
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Jumlah minimal halaman Proposal adalah <strong>30 Halaman </strong> dan Laporan Skripsi <strong>60 Halaman.</strong>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Bagaimana alur yang harus dilalui untuk melakukan pengajuan Surat Survey?
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#FaqAccordion">
                <div class="accordion-body">
                    Pengajuan <strong> Surat survey </strong> dilakukan dengan menentukan <strong> tempat </strong> dan <strong> durasi survey </strong> setelah kedua hal tersebut didapatkan, mahasiswa cukup mengisi <strong> form pengajuan survey </strong> lalu menunggu pengecekan data dari <strong> Koordinator.</strong> Apabila survey disetujui maka koodinator akan membuatkan surat untuk digunakan sebagai izin survey yang nantinya bisa diambil di <strong> CSR jurusan.</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script src="{{ URL::asset('/assets2/js/app.min.js') }}"></script>
@endsection
