@extends('layout.master')

@section('title', 'Revisi Sidang Skripsi')

{{-- Bagian konten utama halaman revisi sidang skripsi --}}
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Revisi Sidang Skripsi</h4>
        </div>
    </div>

    {{-- Informasi tambahan yang di-comment --}}
    {{-- <h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini, silahkan melaporkan jika terjadi error atau bug pada sistem yang sedang digunakan.</h6> --}}

    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- Cek apakah revisi sidang skripsi sudah tersedia atau belum --}}
            @if (is_null($revisisk) || is_null($revisisk->id_berita_acara_s))
                <div class="alert alert-warning" role="alert">
                    Harap mendaftar sidang skripsi terlebih dahulu / Revisi belum dicetak oleh koordinator.
                </div>
            @else
                {{-- Menampilkan review revisi sidang skripsi --}}
                <div class="card mb-4">
                    <h5 class="card-header">Review Sidang Skripsi</h5>
                    <div class="card-body">
                        <p class="revisi-rumusan-masa">
                            <span class="span0-1">Revisi:<br /></span>
                            @foreach ($revisisk2 as $revisi)
                                <span class="span0-1">{{ $revisi->revisi }} dari {{ $revisi->name }}</span></br>
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">Review Tambahan</h5>
                    <div class="card-body">
                        <p class="revisi-rumusan-masa">
                            <span class="span0-1">Revisi:<br /></span>
                            @if (!is_null($detailrev))
                                @foreach ($detailrev as $revisi)
                                    <div class="revision-item">
                                        <span class="span0-1">{{ $revisi->revisi }} dari {{ $revisi->name }}</span>
                                    </div>
                                @endforeach
                            @else
                                <span class="span0-1 alert alert-warning">Menunggu review dari dosen</span><br>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        {{-- Menampilkan status persetujuan revisi oleh dosen --}}
                        <div class="card mb-4">
                            <h5 class="card-header">Acc Revisi Skripsi</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="dospem" id="dospem"
                                            {{ $revisisk->acc_dospem ? 'checked disabled' : '' }} disabled />
                                        <label class="form-check-label" for="dospem"> Dosen Pembimbing </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosenpenguji1"
                                            id="dosenpenguji1" {{ $revisisk->acc_penguji_1 ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dosenpenguji1"> Dosen Penguji 1 </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosenpenguji2"
                                            id="dosenpenguji2" {{ $revisisk->acc_penguji_2 ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dosenpenguji2"> Dosen Penguji 2 </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dosenpenguji3"
                                            id="dosenpenguji3" {{ $revisisk->acc_penguji_3 ? 'checked disabled' : '' }}
                                            disabled />
                                        <label class="form-check-label" for="dosenpenguji2"> Dosen Penguji 3 </label>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        {{-- Tombol selesai yang aktif hanya jika semua persetujuan diberikan --}}
                                        @if (is_null($revisisk->acc_dospem) ||
                                                is_null($revisisk->acc_penguji_1) ||
                                                is_null($revisisk->acc_penguji_2) ||
                                                is_null($revisisk->acc_penguji_3))
                                            <button type="submit" class="btn btn-inverse-danger" disabled>
                                                Selesai
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-inverse-success"
                                                onclick="handleButtonClick()" disabled>
                                                Selesai
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Link ke history revisi sidang skripsi --}}
                <div class="mb-3">
                    <a href="{{ route('his-rev-mhs.index') }}" class="btn btn-primary">History Revisi Sidang Skripsi</a>
                </div>
            @endif
        </div>
    </div>

@endsection

{{-- Menyertakan script jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- ... Bagian HTML lainnya ... -->

{{-- Menyertakan script SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
