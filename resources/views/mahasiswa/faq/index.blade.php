@extends('layout.master')

@section('title', 'Info Penting')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0">Info Penting</h4>
    </div>
    <h6 class="mb-4">Informasi penting dapat anda cari pada halaman ini.</h6>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Pertanyaan yang Sering Diajukan</h6>
                    <div class="accordion" id="FaqAccordion">
                        @php
                            // Mendefinisikan array dengan pertanyaan dan jawaban yang sering diajukan
                            $faqs = [
                                [
                                    'id' => 'One',
                                    'question' =>
                                        'Bagaimana alur yang harus dilalui untuk melakukan pengajuan judul proposal skripsi?',
                                    'answer' =>
                                        'Pengajuan judul <strong>Proposal Skripsi</strong> dimulai dengan memilih <strong>Bidang ilmu</strong> sesuai dengan yang sudah disediakan, lalu dilanjutkan dengan mengisi <strong>Form pengajuan</strong> tema/judul skripsi dan menunggu persetujuan dari <strong>Koordinator</strong> mengenai judul yang diajukan serta pembagian <strong>Dosen Pembimbing</strong> yang sesuai dengan bidang ilmu yang diambil untuk dilanjutkan ke proses Bimbingan Proposal skripsi. Setelah proses pembimbingan selesai dilakukan, mahasiswa dapat melakukan pendaftaran <strong>Sidang Proposal Skripsi.</strong> Pengajuan sidang yang dilakukan akan diproses oleh Koordinator untuk dibuatkan <strong>Jadwal Sidang Proposal,</strong> lalu setelah Sidang Proposal dilaksanakan mahasiswa perlu mengerjakan revisi dari <strong>Dosen Penguji.</strong> Barulah mahasiswa dapat mengajukan <strong>Surat Tugas</strong> untuk dibuatkan sebagai bukti <strong>Bimbingan Laporan Skripsi</strong> dengan Dosen Pembimbing. Setelah Bimbingan Laporan Skripsi dilakukan minimal sebanyak 12 kali pertemuan, mahasiswa dapat melakukan pendaftaran <strong>Sidang Skripsi</strong> serta mengerjakan revisi berdasarkan dari Sidang yang dilakukan.',
                                ],
                                [
                                    'id' => 'Two',
                                    'question' =>
                                        'Berapa lama jangka waktu berlakunya topik skripsi yang masih dapat disidangkan?',
                                    'answer' =>
                                        'Jangka waktu berlaku Topik Skripsi adalah 2 kali 6 bulan sejak Surat Tugas dikeluarkan.',
                                ],
                                [
                                    'id' => 'Three',
                                    'question' =>
                                        'Apa yang harus dipersiapkan untuk melakukan pendaftaran Sidang Proposal, Sidang Skripsi, Surat survey atau Surat Tugas?',
                                    'answer' =>
                                        'Persiapan pendaftaran Sidang Proposal, Sidang Skripsi, Surat Tugas memerlukan: <br>1. File Proposal Skripsi/Laporan Skripsi yang sudah di ACC dosen pembimbing <br>2. File Slip bukti pembayaran Sidang yang sudah dibayarkan di loke pembayaran kampus <br>Persiapan pendaftaran Surat Survey: <br>1. Tempat survey <br>2. Lama Durasi survey <br>',
                                ],
                                [
                                    'id' => 'Four',
                                    'question' =>
                                        'Berapa jumlah nominal yang harus dibayarkan pada setiap pendaftaran Sidang Proposal, Pengajuan Surat Tugas, Pendaftaran Sidang Skiripsi, dll?',
                                    'answer' =>
                                        'Jumlah yang harus dibayarkan setiap pendaftaran: <br>• Pendaftaran Seminar Proposal : Rp. xxx.xxx <br>• Pengajuan Surat Tugas : Rp. xxx.xxx <br>• Pendaftaran Sidang Skripsi : Rp. xxx.xxx <br>',
                                ],
                                // [
                                //     'id' => 'Five',
                                //     'question' =>
                                //         'Berapa jumlah minimal halaman untuk sebuah Proposal Skripsi dan Laporan Skripsi?',
                                //     'answer' =>
                                //         'Jumlah minimal halaman Proposal adalah <strong>30 Halaman</strong> dan Laporan Skripsi <strong>60 Halaman.</strong>',
                                // ],
                                [
                                    'id' => 'Six',
                                    'question' =>
                                        'Bagaimana alur yang harus dilalui untuk melakukan pengajuan Surat Survey?',
                                    'answer' =>
                                        'Pengajuan <strong>Surat survey</strong> dilakukan dengan menentukan <strong>tempat</strong> dan <strong>durasi survey</strong> setelah kedua hal tersebut didapatkan, mahasiswa cukup mengisi <strong>form pengajuan survey</strong> lalu menunggu pengecekan data dari <strong>Koordinator.</strong> Apabila survey disetujui maka koodinator akan membuatkan surat untuk digunakan sebagai izin survey yang nantinya bisa diambil di <strong>CSR jurusan.</strong>',
                                ],
                            ];
                        @endphp
                        @foreach ($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                                    <button
                                        class="accordion-button @if ($loop->first) @else collapsed @endif"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq['id'] }}"
                                        aria-expanded="@if ($loop->first) true @else false @endif"
                                        aria-controls="collapse{{ $faq['id'] }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq['id'] }}"
                                    class="accordion-collapse collapse @if ($loop->first) show @endif"
                                    aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq['answer'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets2/js/app.min.js') }}"></script>
@endsection
