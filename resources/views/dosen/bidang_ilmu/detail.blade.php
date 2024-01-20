@extends('layout.master3')

@section('title')
Detail Revisi Sidang Proposal
@endsection

@section('css')

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Bidang Ilmu</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tema Penelitian</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <h5 class="card-header">Detail Tema Penelitian</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Topik Bidang Ilmu </label>
                            @if ($bidetail)
                                <input type="text" class="form-control" value="{{ $bidetail->topik_bidang_ilmu }}" readonly>
                            @else
                                <p>No data found.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Mata Kuliah Pendukung </label>
                            @if ($bidetail)
                                @php
                                    $mataKuliahIDs = explode(',', $bidetail->mata_kuliah_pendukung);
                                    $mataKuliahs = App\Models\MataKuliahPendukung::whereIn('id_mata_kuliah_pendukung', $mataKuliahIDs)->get();
                                    $mataKuliahNames = implode(', ', $mataKuliahs->pluck('nama_mata_kuliah')->toArray());
                                @endphp

                                <input type="text" class="form-control" value="{{ $mataKuliahNames }}" readonly>
                            @else
                                <p>No data found.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan Singkat</label>
                            @if ($bidetail)
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="5" placeholder="Masukan keterangan singkat mengenai tema/judul penelitian" readonly>{{$bidetail->keterangan}}</textarea>
                            @else
                                <p>No data found.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <form action="{{route('dosen-bidang-ilmu.store')}}" method="POST"enctype="multipart/form-data"> --}}
                <form action="{{ route('dosen-bidang-ilmu.store', ['id' => $bidetail->id_bidang_ilmu]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="file_proposal" class="form-label">Upload File Paper Acuan Referensi</label>
                            <input class="form-control" type="file" id="paper" name="paper[]" multiple />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Papers Section -->
    <div class="col-md-6 stretch-card">
        <div class="card">
            <h5 class="card-header">Paper Acuan / Referensi</h5>
            <div class="card-body">
                @if ($paper->count() > 0)
                    @foreach ($paper as $p)
                        <div class="row">
                            <h5>
                                <a href="{{ asset($p->file) }}" target="_blank">
                                    <i data-feather="file-text"></i> <!-- Feather icon for file -->
                                    {{ basename($p->file) }}
                                </a>
                            </h5>
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada paper yang ditemukan untuk bidang ilmu ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
