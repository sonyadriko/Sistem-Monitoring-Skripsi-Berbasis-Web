// wizard.js
$(function() {
    'use strict';

    $("#wizard").steps({
      headerTag: "h2",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      onStepChanging: function (event, currentIndex, newIndex) {
        // Validasi data di setiap langkah jika diperlukan
        return true; // Kembalikan true jika data valid
      },
      onFinished: function (event, currentIndex) {
        // Tampilkan konfirmasi sebelum menyimpan perubahan
        showConfirmation();
      }
    });

    // Fungsi untuk menampilkan konfirmasi menggunakan SweetAlert
    function showConfirmation() {
      // Gunakan SweetAlert untuk menampilkan pesan konfirmasi sederhana
      Swal.fire({
        title: 'Are you sure?',
        text: 'Apakah Anda ingin menyimpan perubahan?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika pengguna mengklik "Yes," panggil fungsi saveChanges
          saveChanges();
        }
      });
    }

    // Fungsi untuk menyimpan perubahan
    function saveChanges() {
      // Anda dapat menambahkan logika untuk menyimpan perubahan ke server di sini
      var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID sebenarnya dari formulir Anda

      // Standard form submission
      form.submit();
    }
  });
