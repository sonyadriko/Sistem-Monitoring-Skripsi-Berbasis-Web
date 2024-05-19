@extends('layout.master')

@section('title', 'Revisi Sidang Proposal')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bagian header halaman revisi sidang proposal -->
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <h4 class="mb-3 mb-md-0">Revisi Sidang Proposal</h4>
    </div>

    <!-- Konten utama halaman revisi sidang proposal -->
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Pengecekan kondisi apakah mahasiswa sudah terdaftar sidang proposal -->
            @if (is_null($revisisp) || is_null($revisisp->id_berita_acara_p) || is_null($revisisp->id_revisi_seminar_proposal))
                <div class="alert alert-warning" role="alert">
                    Harap mendaftar sidang proposal terlebih dahulu. / Revisi belum dicetak oleh koordinator.
                </div>
            @else
                <!-- Menampilkan review sidang proposal -->
                <div class="card mb-4">
                    <h5 class="card-header">Review Sidang Proposal</h5>
                    <div class="card-body">
                        <p class="revisi-rumusan-masa">
                            <span class="span0-1">Revisi : <br /></span>
                            <!-- Menampilkan detail revisi jika ada -->
                            @if (!is_null($detailrev))
                                @php
                                    $groupedRevisions = collect($detailrev)->groupBy('users_id');
                                @endphp

                                @foreach ($groupedRevisions as $userId => $revisions)
                                    @foreach ($revisions as $revisi)
                                        <span class="span0-1">{{ $revisi->revisi }} dari
                                            {{ $revisi->unique_names }}</span><br>
                                    @endforeach
                                @endforeach
                            @else
                                <span class="span0-1 alert alert-warning">Menunggu review dari dosen</span><br>
                            @endif
                        </p>
                    </div>
                </div>
                <!-- Menampilkan status persetujuan revisi oleh dosen -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Acc Revisi Sidang Proposal</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" name="dospem"
                                            id="dospem" {{ $revisisp->acc_dospem ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dospem"> Dosen Pembimbing </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosenpenguji1"
                                            id="dosenpenguji1" {{ $revisisp->acc_penguji_1 ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dosenpenguji1"> Dosen Penguji 1 </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosenpenguji2"
                                            id="dosenpenguji2" {{ $revisisp->acc_penguji_2 ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dosenpenguji2"> Dosen Penguji 2 </label>
                                    </div>
                                    <!-- Tombol untuk pengajuan surat tugas jika semua persetujuan diberikan -->
                                    <div class="d-flex justify-content-between mt-4">
                                        @if (is_null($revisisp->acc_dospem) || is_null($revisisp->acc_penguji_1) || is_null($revisisp->acc_penguji_2))
                                            <button type="submit" class="btn btn-inverse-danger" disabled">
                                                Belum bisa pengajuan surat tugas
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-inverse-success"
                                                onclick="handleButtonClick()">
                                                Daftar Surat Tugas
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Link ke halaman history revisi sidang proposal -->
                <div class="mb-3">
                    <a href="{{ route('his-rev-pro.index') }}" class="btn btn-primary">History Revisi Sidang Proposal</a>
                </div>
            @endif
        </div>
    </div>

@endsection

<!-- Script untuk handle button click yang mengarahkan ke halaman pengajuan surat tugas -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function handleButtonClick() {
        window.location.href = "{{ route('pengajuan-st.check') }}";
    }
</script>

