@extends('layout.master')

@section('title')
    Detail Berita Acara Proposal
@endsection

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
            <li class="breadcrumb-item active" aria-current="page">BA Sidang Proposal</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Berita Acara Sidang Proposal</h5>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">NPM </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->kode_unik }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">No. Ujian </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->id_berita_acara_p }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Nama </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->name }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Tanggal</label>
                                </div>
                                <div class="col-sm-9">
                                    @php
                                        $dateFromDatabase = $data->tanggal;
                                        $formattedDate = date('d F Y', strtotime($dateFromDatabase));
                                    @endphp
                                    <p><span>{{ $formattedDate }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Judul </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->judul }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Ruang, Waktu </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->nama_ruangan }}, {{ $data->jam }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1 </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->dosen_pembimbing_utama }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2 </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->dosen_pembimbing_ii }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Dosen Penguji </label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->nama_penguji_1 }} (Dosen Penguji 1)<br />
                                            {{ $data->nama_penguji_2 }} (Dosen Penguji 2)s</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            @if ($detail && $detail->revisi)
                {{-- <div class="card mb-3">
    <h5 class="card-header">Review Dosen Pembimbing</h5>
    <form action="{{ route('berita-acara-proposal.store') }}" method="POST" id="reviewForm">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="revisi" class="form-label">Revisi</label>
                <span></span>
            </div>
            <div class="mb-3">
                <label for="nilai" class="form-label">Nilai 1</label>
                <span></span>
            </div>
        </div>
    </form>
</div> --}}
            @else
                <div class="card mb-3">
                    <h5 class="card-header">Review Dosen Pembimbing</h5>
                    <form action="{{ route('berita-acara-proposal.store') }}" method="POST" id="reviewForm">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="revisi" class="form-label">Revisi</label>
                                <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
                                @error('revisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="number" class="form-control" name="nilai" max="100" id="nilai"
                                    placeholder="Masukan Nilai nilai..." aria-describedby="defaultFormControlHelp" />
                                @error('nilai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="berita_acara_proposal_id"
                                value="{{ $data->id_berita_acara_p }}" />
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.history.back();">Kembali</button>
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
        var nilai = document.getElementById('nilai').value;

        if (!revisi.trim() || !nilai.trim()) {
            Swal.fire({
                title: 'Error',
                text: 'Revisi dan nilai harus diisi.',
                icon: 'error',
            });
        } else if (parseInt(nilai) > 100) {
            Swal.fire({
                title: 'Error',
                text: 'Nilai tidak boleh lebih dari 100.',
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
            showCancelButton: false, // Set to false to hide the "Cancel" button
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
                });
            }
        });
    }
</script>
