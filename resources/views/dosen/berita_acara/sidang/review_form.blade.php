<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Cek apakah detail revisi sudah ada, jika tidak, tampilkan form -->
        @if (!$detail || !$detail->revisi)
            <div class="card mb-3">
                <!-- Judul kartu untuk review dosen pembimbing -->
                <h5 class="card-header">Review Dosen Pembimbing</h5>
                <!-- Form untuk mengirim review -->
                <form action="{{ route('berita-acara-skripsi.store') }}" method="POST" id="reviewForm">
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
                        <!-- Label dan input untuk nilai dengan perulangan -->
                        @php
                            $labels = [
                                'Penulisan',
                                'Penyajian',
                                'Penguasaan Program',
                                'Penguasaan Materi',
                                'Penampilan',
                            ];
                        @endphp
                        @for ($i = 0; $i < 5; $i++)
                            <div class="mb-3">
                                <label for="nilai_{{ $i + 1 }}" class="form-label">Nilai {{ $labels[$i] }}</label>
                                <input type="number" class="form-control" name="nilai_{{ $i + 1 }}"
                                    max="100" id="nilai_{{ $i + 1 }}"
                                    placeholder="Masukkan Nilai {{ $labels[$i] }}..."
                                    aria-describedby="defaultFormControlHelp" />
                                <!-- Menampilkan pesan error jika validasi nilai gagal -->
                                @error('nilai_' . ($i + 1))
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endfor
                        <!-- Input tersembunyi untuk menyimpan ID berita acara skripsi -->
                        <input type="hidden" name="berita_acara_skripsi_id"
                            value="{{ $data->id_berita_acara_s }}" />
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

