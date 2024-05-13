<div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">Detail Mahasiswa - {{ $data->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">NPM</label>
                                        <p><span>{{ $data->kode_unik }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Nama</label>
                                        <p><span>{{ $data->name }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Judul</label>
                                        <p><span>{{ $data->judul ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Bidang Ilmu</label>
                                        <p><span>{{ $data->topik_bidang_ilmu ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing
                                            Utama</label>
                                        <p><span>{{ $data->dosen_pembimbing_utama ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Dosen Pembimbing
                                            Pendamping</label>
                                        <p><span>{{ $data->dosen_pembimbing_ii ?? 'Belum Mengajukan' }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Alamat</label>
                                        <p><span>{{ $data->alamat_orang_tua ?? 'Tidak Ada' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: bold">Nomor Telepon Orang
                                            Tua</label>
                                        <p><span>{{ $data->no_telp_orang_tua ?? 'Tidak Ada' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
