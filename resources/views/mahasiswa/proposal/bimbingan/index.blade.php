@extends('layout.master')

@section('title', 'Bimbingan Proposal')

@section('content')
<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Bimbingan Proposal</h4>
  </div>
</div>
<h6 class="mb-4">Seluruh informasi mengenai bimbingan akan ditampilkan dibawah ini.</h6>
<div class="row">
    <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <!-- Memeriksa apakah dosen sudah diatur atau belum -->
        @if(is_null($dosens) || is_null($dosens->id_bimbingan_proposal))
        <div class="alert alert-warning" role="alert">
            Harap ajukan judul terlebih dahulu sebelum melanjutkan.
        </div>
    </div>
</div>
        @else
        <div class="card">
            <h5 class="card-header">Review Bimbingan Proposal</h5>
            <div class="card-body mb-4">
                <span class="span0-1 mt-4 mb-4" style="font-weight: bold">Revisi : <br> <br></span>
                <!-- Menampilkan revisi atau status menunggu dari dosen pembimbing -->
                @if (!is_null($detailbim))
                    @if (is_null($detailbim->revisi))
                        <span class="span0-1 alert alert-warning">Menunggu review dari dosen pembimbing</span><br>
                    @else
                        <span class="span0-1">{{ $detailbim->revisi }}</span><br>
                    @endif
                @else
                    <span class="span0-1 alert alert-warning">Menunggu review dari dosen pembimbing</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-4 grid-margin stretch-card">
        <!-- Menampilkan persetujuan seminar berdasarkan status dosen pembimbing -->
        @if ($dosens->dosen_pembimbing_ii == 'tidak ada')
        <div class="card mb-4">
            <h5 class="card-header">Persetujuan Seminar</h5>
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $dosens->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                        <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <!-- Tombol untuk mendaftar jika sudah mendapat persetujuan -->
                        @if(is_null($dosens->acc_dosen_utama))
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
            <h5 class="card-header">Persetujuan Seminar</h5>
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="persetujuan1" id="persetujuan1" {{ $dosens->acc_dosen_utama ? 'checked disabled' : '' }} disabled/>
                        <label class="form-check-label" for="persetujuan1"> Dosen Pembimbing 1 </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="persetujuan2" id="persetujuan2" {{ $dosens->acc_dosen_ii ? 'checked disabled' : '' }} disabled />
                        <label class="form-check-label" for="persetujuan2"> Dosen Pembimbing 2 </label>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <!-- Tombol untuk mendaftar jika sudah mendapat persetujuan dari kedua dosen -->
                        @if(is_null($dosens->acc_dosen_utama) || is_null($dosens->acc_dosen_ii))
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
<div class="col-md-12 col-lg-6 col-xl-4">
    <a href="{{ route('his-bim-mhs.index') }}" class="btn btn-primary">History Bimbingan</a>
</div>
@endif
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function handleButtonClick() {
        // Check your conditions here
            // Redirect to the specified route
            window.location.href = "{{ route('seminar-proposal.check') }}";
        // }
    }

</script>
