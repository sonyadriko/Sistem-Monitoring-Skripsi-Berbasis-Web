 <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Cek apakah detail revisi sudah ada, jika belum, tampilkan form -->
            @if (!($detail && $detail->revisi))
                <div class="card mb-3">
                    <!-- Judul kartu untuk review dosen pembimbing -->
                    <h5 class="card-header">Review Dosen Pembimbing</h5>
                    <!-- Form untuk mengirim review -->
                    <form action="{{ route('berita-acara-proposal.store') }}" method="POST" id="reviewForm">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <div class="card-body">
                            <!-- Input untuk revisi -->
                            <div class="mb-3">
                                <label for="revisi" class="form-label">Revisi</label>
                                <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
                                <!-- Menampilkan pesan error jika validasi revisi gagal -->
                                @error('revisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Input untuk nilai -->
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="number" class="form-control" name="nilai" max="100" id="nilai"
                                    placeholder="Masukan Nilai..." aria-describedby="defaultFormControlHelp" />
                                <!-- Menampilkan pesan error jika validasi nilai gagal -->
                                @error('nilai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Input tersembunyi untuk menyimpan ID berita acara proposal -->
                            <input type="hidden" name="berita_acara_proposal_id"
                                value="{{ $data->id_berita_acara_p }}" />
                            <!-- Tombol untuk kembali dan submit -->
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