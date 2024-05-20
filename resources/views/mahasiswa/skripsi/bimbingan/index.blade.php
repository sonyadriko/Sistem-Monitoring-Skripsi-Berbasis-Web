@extends('layout.master')

@section('title', 'Bimbingan Skripsi')

@section('content')
    {{-- Menampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Bimbingan Skripsi</h4>
        </div>
    </div>
    <h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini.</h6>
    <div class="row">
        <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            {{-- Menampilkan peringatan jika belum memiliki surat tugas bimbingan --}}
            @if (is_null($bimbingans) || is_null($bimbingans->id_bimbingan_skripsi))
                <div class="alert alert-warning" role="alert">
                    Harap selesaikan tahap proposal terlebih dahulu sampai mempunyai surat tugas bimbingan.
                </div>
        </div>
    </div>
@else
    <div class="card mb-4">
        <h5 class="card-header">Review Bimbingan Skripsi</h5>
        <div class="card-body">
            {{-- Menampilkan revisi bimbingan skripsi --}}
            <span class="span0-1 mt-4 mb-4" style="font-weight: bold">Revisi : <br> <br></span>
            @if (!is_null($detailbim) && !is_null($detailbim->revisi))
                <span class="span0-1">{{ $detailbim->revisi }}</span><br>
            @else
                <span class="span0-1 text-danger">Menunggu review dari dosen pembimbing</span><br>
            @endif
        </div>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            {{-- Menampilkan persetujuan sidang berdasarkan jumlah dosen pembimbing --}}
            @if ($bimbingans->dosen_pembimbing_ii == 'tidak ada')
                <div class="card mb-4">
                    <h5 class="card-header">Persetujuan Sidang</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1"
                                    {{ $bimbingans->acc_dosen_utama ? 'checked disabled' : '' }} disabled />
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                @if (is_null($bimbingans->acc_dosen_utama))
                                    <button type="submit" class="btn btn-secondary" disabled">
                                        Daftar
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary" onclick="handleButtonClick()">
                                        Daftar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <h5 class="card-header">Persetujuan Sidang</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1"
                                    {{ $bimbingans->acc_dosen_utama ? 'checked disabled' : '' }} disabled />
                                <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="persetujuan2" id="persetujuan2"
                                    {{ $bimbingans->acc_dosen_ii ? 'checked disabled' : '' }} disabled />
                                <label class="form-check-label" for="persetujuan2"> Dosen Pembimbing 2 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                @if (is_null($bimbingans->acc_dosen_utama) || is_null($bimbingans->acc_dosen_ii))
                                    <button type="submit" class="btn btn-secondary" disabled">
                                        Daftar
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary" onclick="handleButtonClick()">
                                        Daftar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-lg-8">
        {{-- Link ke halaman history bimbingan --}}
        <a href="{{ route('his-bims-mhs.index') }}" class="btn btn-primary">History Bimbingan</a>
    </div>

    @endif
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- ... Bagian HTML lainnya ... -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Fungsi untuk menangani klik tombol pada halaman
    function handleButtonClick() {
        // Mengarahkan ulang ke halaman pemeriksaan sidang skripsi
        window.location.href = "{{ route('sidang-skripsi.check') }}";
    }

    // Menunggu hingga seluruh elemen DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan referensi tombol submit
        const submitBtn = document.getElementById('submitBtn');

        // Menambahkan event listener jika tombol submit ditemukan
        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                // Mencegah perilaku default form submission
                event.preventDefault();

                // Mengambil file dan ID bimbingan skripsi dari form
                const file = document.getElementById('file_skripsi').files[0];
                const bimbinganSkripsiId = document.getElementById('bimbingan_skripsi_id').value;

                // Memeriksa jika file dan ID bimbingan skripsi ada
                if (file && bimbinganSkripsiId) {
                    // Membuat FormData untuk dikirim melalui fetch
                    const formData = new FormData();
                    formData.append('file_skripsi', file);
                    formData.append('bimbingan_skripsi_id', bimbinganSkripsiId);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Melakukan request POST untuk menyimpan data
                    fetch('{{ route('bimbingans-mhs.store') }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            // Memeriksa jika response tidak ok
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Menangani response jika berhasil
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'File Skripsi Berhasil Disubmit!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Mengarahkan ulang ke halaman index bimbingan
                                    window.location.href = "{{ route('bimbingans-mhs.index') }}";
                                });
                            } else {
                                // Menampilkan pesan error jika ada masalah
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            // Menangani error pada fetch
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while submitting the file.'
                            });
                        });
                } else {
                    // Menampilkan pesan error jika file tidak dipilih
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please select a file.'
                    });
                }
            });
        } else {
            // Menampilkan error jika elemen dengan ID "submitBtn" tidak ditemukan
            console.error('Element with ID "submitBtn" not found.');
        }
    });
</script>
