<script>
    /**
     * Fungsi untuk mengirimkan form setelah validasi.
     */
    function submitForm() {
        // Mengambil nilai dari elemen form
        var revisi = document.getElementById('revisi').value;
        var nilai_1 = document.getElementById('nilai_1').value;
        var nilai_2 = document.getElementById('nilai_2').value;
        var nilai_3 = document.getElementById('nilai_3').value;
        var nilai_4 = document.getElementById('nilai_4').value;
        var nilai_5 = document.getElementById('nilai_5').value;

        // Mengkonversi nilai ke integer
        nilai_1 = parseInt(nilai_1);
        nilai_2 = parseInt(nilai_2);
        nilai_3 = parseInt(nilai_3);
        nilai_4 = parseInt(nilai_4);
        nilai_5 = parseInt(nilai_5);

        // Validasi revisi dan nilai
        if (!revisi.trim() || nilai_1 > 100 || nilai_2 > 100 || nilai_3 > 100 || nilai_4 > 100 || nilai_5 > 100) {
            Swal.fire({
                title: 'Error',
                text: 'Revisi dan nilai harus diisi dengan benar (nilai maksimal 100).',
                icon: 'error',
            });
        } else {
            showConfirmation();
        }
    }

    /**
     * Fungsi untuk menampilkan konfirmasi sebelum submit data.
     */
    function showConfirmation() {
        Swal.fire({
            title: 'Konfirmasi Submit',
            text: 'Apakah Anda yakin ingin submit data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Submit!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sukses',
                    text: 'Berhasil Submit Berita Acara Sidang Skripsi.',
                    icon: 'success',
                }).then(() => {
                    // Proses submit form
                    document.getElementById('reviewForm').submit();
                }).then(() => {
                    // Redirect ke dashboard setelah submit berhasil
                    // window.location.href = '/dashboard'; // Ganti dengan route dashboard yang sesuai
                });
            }
        });
    }
</script>
