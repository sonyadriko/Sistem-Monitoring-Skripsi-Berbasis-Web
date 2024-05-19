  <div class="row">
        <div class="mb-3">
            <div class="card mb-4">
                <h5 class="card-header">Persetujuan Revisi Sidang Skripsi</h5>
                <div class="card-body">
                    <span class="span0-1">Persetujuan Revisi </span>
                    <input type="hidden" id="dospem" value="{{ $data->dosen_pembimbing_utama }}">
                    <input type="hidden" id="penguji1" value="{{ $data->nama_penguji_1 }}">
                    <input type="hidden" id="penguji2" value="{{ $data->nama_penguji_2 }}">
                    <input type="hidden" id="penguji3" value="{{ $data->nama_penguji_3 }}">
                    @if (Auth::user()->name == $data->nama_penguji_1)
                        @if ($data->acc_penguji_1 == null)
                            <button type="button" id="penguji1" value="{{ $data->nama_penguji_1 }}"
                                class="btn btn-primary accept-button"
                                onclick="confirmAccSkripsi('{{ $data->id_berita_acara_s }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pada {{ $data->tgl_acc_penguji_1 }} </span>
                        @endif
                    @elseif (Auth::user()->name == $data->nama_penguji_2)
                        @if ($data->acc_penguji_2 == null)
                            <button type="button" id="penguji2" value="{{ $data->nama_penguji_2 }}"
                                class="btn btn-primary accept-button"
                                onclick="confirmAccSkripsi('{{ $data->id_berita_acara_s }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pada {{ $data->tgl_acc_penguji_2 }} </span>
                        @endif
                    @elseif (Auth::user()->name == $data->nama_penguji_3)
                        @if ($data->acc_penguji_3 == null)
                            <button type="button" id="penguji2" value="{{ $data->nama_penguji_3 }}"
                                class="btn btn-primary accept-button"
                                onclick="confirmAccSkripsi('{{ $data->id_berita_acara_s }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pada {{ $data->tgl_acc_penguji_3 }} </span>
                        @endif
                    @elseif (Auth::user()->name == $data->dosen_pembimbing_utama)
                        @if ($data->acc_dospem == null)
                            <button type="button" id="dospem" value="{{ $data->dosen_pembimbing_utama }}"
                                class="btn btn-primary accept-button"
                                onclick="confirmAccSkripsi('{{ $data->id_berita_acara_s }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pada {{ $data->tgl_acc_dospem }} </span>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>