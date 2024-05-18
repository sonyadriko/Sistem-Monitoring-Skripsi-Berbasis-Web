 <div class="mb-3">
        <div class="card mb-4">
            <h5 class="card-header">Persetujuan Sidang Skripsi</h5>
            <div class="card-body">
                <span class="span0-1">Persetujuan Skripsi :</span>
                <input type="hidden" id="dospem1" value="{{ $data->dosen_pembimbing_utama }}">
                <input type="hidden" id="dospem2" value="{{ $data->dosen_pembimbing_ii }}">
                @if (count($detail) >= 12)
                    @if (Auth::user()->name == $data->dosen_pembimbing_utama)
                        @if ($data->acc_dosen_utama == null)
                            <button type="button" id="accProposalBtn" class="btn btn-primary accept-button"
                                onclick="confirmAccProposal('{{ $data->id_bimbingan_skripsi }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pembimbing utama pada
                                {{ \Carbon\Carbon::parse($data->tgl_acc_dosen_utama)->format('d-m-Y H:i:s') }} </span>
                        @endif
                    @elseif (Auth::user()->name == $data->dosen_pembimbing_ii)
                        @if ($data->acc_dosen_ii == null)
                            <button type="button" id="accProposalBtn" class="btn btn-primary accept-button"
                                onclick="confirmAccProposal('{{ $data->id_bimbingan_skripsi }}')">
                                Setujui Skripsi
                            </button>
                        @else
                            <span class="span0-1">Sudah di acc oleh dosen pembimbing ii pada
                                {{ \Carbon\Carbon::parse($data->tgl_acc_dosen_ii)->format('d-m-Y H:i:s') }} </span>
                        @endif
                    @endif
                @else
                    <span class="span0-1 text-danger">Bimbingan harus dilakukan minimal 12x </span>
                @endif
            </div>
        </div>
    </div>