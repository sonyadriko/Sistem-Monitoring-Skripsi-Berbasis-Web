<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\PengajuanJudulController;
use App\Http\Controllers\BidangIlmuController;
use App\Http\Controllers\KoordinatorJudulController;
use App\Http\Controllers\KoordinatorSeminarController;
use App\Http\Controllers\PembagianDosenController;
use App\Http\Controllers\BimbinganProposalController;
use App\Http\Controllers\DosenBimbinganProposalController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KoordinatorSuratTugasController;
use App\Http\Controllers\BeritaAcaraProposalController;
use App\Http\Controllers\SeminarProposalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KoordinatorBeritaAcaraProposalController;
use App\Http\Controllers\RevisiSeminarProposalController;
use App\Http\Controllers\HistoryBimbinganController;
use App\Http\Controllers\BimbinganSkripsiController;
use App\Http\Controllers\DosenRevisiSeminarProposal;
use App\Http\Controllers\SidangSkripsiController;
use App\Http\Controllers\KoordinatorSidangSkripsiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KoordinatorBeritaAcaraSkripsiController;
use App\Http\Controllers\BeritaAcaraSkripsiController;
use App\Http\Controllers\RevisiSidangSkripsiController;
use App\Http\Controllers\DosenRevisiSidangSkripsiController;
use App\Http\Controllers\PenjadwalanKoordinatorController;
use App\Http\Controllers\DosenBimbinganSkripsiController;
use App\Http\Controllers\HistoryBimbinganSkripsiController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\KajurDataMahasiswaController;
use App\Http\Controllers\KajurDataDosenController;
use App\Http\Controllers\KajurDataBidangIlmuController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\KoordinatorLaporanTahunanController;
use App\Http\Controllers\SuratSurveyController;
use App\Http\Controllers\MataKuliahPendukungController;
use App\Http\Controllers\DosenBidangIlmuController;
use App\Http\Controllers\HistoryRevisiSkripsiController;
use App\Http\Controllers\HistoryRevisiProposalController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KajurJadwalController;
use App\Http\Controllers\KajurSeminarController;
use App\Http\Controllers\KajurSidangController;
use App\Http\Controllers\JadwalMengujiController;
use App\Http\Controllers\SekretarisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

// Auth::routes();

// Route::controller
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')
        ->name('login')
        ->middleware('guest');
    Route::post('/login', 'login')->name('auth');
    Route::post('/auth-logout', 'logout')->name('auth-logout');
    // Route::get('/reset-auth-logout', 'password_reset_logout')->name('reset-auth-logout');
});


Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register-form')
    ->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])->name('register');


// Route::group(['middleware' => 'auth:ketuajurusan'], function() {
    // Grup rute untuk HistoryController
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications'); // Rute untuk mendapatkan notifikasi
    });

    // Grup rute untuk KajurController
    Route::controller(KajurController::class)->group(function () {
        Route::get('/ketua_jurusan', 'index')->name('dashboard:kajur'); // Rute untuk dashboard ketua jurusan
    });

    // Grup rute untuk KajurDataMahasiswaController
    Route::controller(KajurDataMahasiswaController::class)->group(function () {
        Route::get('/ketua_jurusan/data_mahasiswa', 'index')->name('data-mhs'); // Rute untuk melihat data mahasiswa
        Route::get('/ketua_jurusan/data_mahasiswa/detail/{id}', 'detail')->name('data-mhs-detail'); // Rute untuk melihat detail data mahasiswa
    });

    // Grup rute untuk KajurDataDosenController
    Route::controller(KajurDataDosenController::class)->group(function () {
        Route::get('/ketua_jurusan/data_dosen', 'index')->name('data-dsn'); // Rute untuk melihat data dosen
        Route::get('/ketua_jurusan/data_dosen/detail/{id}', 'detail')->name('data-dsn-detail'); // Rute untuk melihat detail data dosen
    });

    // Grup rute untuk KajurDataBidangIlmuController
    Route::controller(KajurDataBidangIlmuController::class)->group(function () {
        Route::get('/ketua_jurusan/data_bidang_ilmu', 'index')->name('data-bi'); // Rute untuk melihat data bidang ilmu
    });

    // Grup rute untuk KajurJadwalController
    Route::controller(KajurJadwalController::class)->group(function () {
        Route::get('/ketua_jurusan/jadwal', 'index')->name('data-jadwal'); // Rute untuk melihat jadwal
    });

    // Grup rute untuk KajurSeminarController
    Route::controller(KajurSeminarController::class)->group(function () {
        Route::get('/ketua_jurusan/seminar', 'index')->name('data-seminar'); // Rute untuk melihat seminar
        Route::get('/ketua_jurusan/seminar/detail/{id}', 'detail')->name('data-seminar.detail'); // Rute untuk melihat detail seminar
    });

    // Grup rute untuk KajurSidangController
    Route::controller(KajurSidangController::class)->group(function () {
        Route::get('/ketua_jurusan/sidang', 'index')->name('data-sidang'); // Rute untuk melihat sidang
        Route::get('/ketua_jurusan/sidang/detail/{id}', 'detail')->name('data-sidang.detail'); // Rute untuk melihat detail sidang
    });

// });


// Route::group(['middleware' => 'auth:dosen'], function() {
    // Grup rute untuk HistoryController
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications'); // Rute untuk mendapatkan notifikasi
    });

    // Grup rute untuk DosenController
    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'index')->name('dashboard:dosen'); // Rute untuk dashboard dosen
    });

    // Grup rute untuk DosenBidangIlmuController
    Route::controller(DosenBidangIlmuController::class)->group(function () {
        Route::get('/dosen/bidang_ilmu', 'index')->name('dosen-bidang-ilmu.index'); // Rute untuk melihat bidang ilmu
        Route::get('/dosen/bidang_ilmu/detail/{id}', 'detail')->name('dosen-bidang-ilmu.detail'); // Rute untuk melihat detail bidang ilmu
        Route::post('/dosen/bidang_ilmu/detail/{id}', 'submitpaper')->name('dosen-bidang-ilmu.store'); // Rute untuk submit paper
    });

    // Grup rute untuk DosenBimbinganProposalController dengan prefix
    Route::group(['prefix' => 'dosen/bimbingan_proposal'], function () {
        Route::get('/', [DosenBimbinganProposalController::class, 'index'])->name('bimbingan-dosen.index'); // Rute untuk melihat bimbingan proposal
        Route::post('/tambahrevisi', [DosenBimbinganProposalController::class, 'tambahrevisi'])->name('bimbingan-dosen.tambahrevisi'); // Rute untuk menambah revisi
        Route::get('/detail/{id}', [DosenBimbinganProposalController::class, 'detail'])->name('bimbingan-dosen.detail'); // Rute untuk melihat detail bimbingan proposal
        Route::post('/updaterevisi/{id}', [DosenBimbinganProposalController::class, 'updaterevisi'])->name('bimbingan-dosen.addrevisi'); // Rute untuk update revisi
        Route::post('/accrevisi/{id}', [DosenBimbinganProposalController::class, 'accrevisi'])->name('bimbingan-dosen.accrevisi'); // Rute untuk acc revisi
        Route::post('/accproposal/{id}', [DosenBimbinganProposalController::class, 'accproposal'])->name('bimbingan-dosen.accproposal'); // Rute untuk acc proposal
    });

    // Grup rute untuk DosenBimbinganSkripsiController dengan prefix
    Route::group(['prefix' => 'dosen/bimbingan_skripsi'], function () {
        Route::get('/', [DosenBimbinganSkripsiController::class, 'index'])->name('bimbingans-dosen.index'); // Rute untuk melihat bimbingan skripsi
        Route::post('/tambahrevisi', [DosenBimbinganSkripsiController::class, 'tambahrevisi'])->name('bimbingans-dosen.tambahrevisi'); // Rute untuk menambah revisi
        Route::get('/detail/{id}', [DosenBimbinganSkripsiController::class, 'detail'])->name('bimbingans-dosen.detail'); // Rute untuk melihat detail bimbingan skripsi
        Route::post('/updaterevisi/{id}', [DosenBimbinganSkripsiController::class, 'updaterevisi'])->name('bimbingans-dosen.addrevisi'); // Rute untuk update revisi
        Route::post('/accrevisi/{id}', [DosenBimbinganSkripsiController::class, 'accrevisi'])->name('bimbingans-dosen.accrevisi'); // Rute untuk acc revisi
        Route::post('/accproposal/{id}', [DosenBimbinganSkripsiController::class, 'accproposal'])->name('bimbingans-dosen.accproposal'); // Rute untuk acc proposal
    });

    // Grup rute untuk BeritaAcaraProposalController dengan prefix
    Route::group(['prefix' => 'dosen/berita_acara_proposal'], function () {
        Route::get('/', [BeritaAcaraProposalController::class, 'index'])->name('berita-acara-proposal.index'); // Rute untuk melihat berita acara proposal
        Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail'); // Rute untuk melihat detail berita acara proposal
        Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store'); // Rute untuk menyimpan berita acara proposal
    });

    // Grup rute untuk JadwalMengujiController dengan prefix
    Route::group(['prefix' => 'dosen/jadwal_menguji'], function () {
        Route::get('/', [JadwalMengujiController::class, 'index'])->name('jadwal-menguji.index'); // Rute untuk melihat jadwal menguji
        Route::get('/detailjadwal/{tanggal}', [JadwalMengujiController::class, 'detailshow'])->name('jadwal-menguji.detailshow'); // Rute untuk melihat detail jadwal menguji
        Route::get('/detail/{id}', [JadwalMengujiController::class, 'detail'])->name('jadwal-menguji.detail'); // Rute untuk melihat detail jadwal menguji
    });

    // Grup rute untuk BeritaAcaraSkripsiController dengan prefix
    Route::group(['prefix' => 'dosen/berita_acara_skripsi'], function () {
        Route::get('/', [BeritaAcaraSkripsiController::class, 'index'])->name('berita-acara-skripsi.index'); // Rute untuk melihat berita acara skripsi
        Route::get('/detail/{id}', [BeritaAcaraSkripsiController::class, 'detail'])->name('berita-acara-skripsi.detail'); // Rute untuk melihat detail berita acara skripsi
        Route::post('/detail/store', [BeritaAcaraSkripsiController::class, 'store'])->name('berita-acara-skripsi.store'); // Rute untuk menyimpan berita acara skripsi
    });

    // Grup rute untuk SekretarisController dengan prefix
    Route::group(['prefix' => 'dosen/sekretaris'], function () {
        Route::get('/', [SekretarisController::class, 'index'])->name('sekretaris-ba.index'); // Rute untuk melihat sekretaris berita acara
        Route::get('/detail/{id}', [SekretarisController::class, 'detail'])->name('sekretaris-ba.detail'); // Rute untuk melihat detail sekretaris berita acara
        Route::post('/detail/store', [SekretarisController::class, 'store'])->name('sekretaris-ba.store'); // Rute untuk menyimpan sekretaris berita acara
    });

    // Grup rute untuk DosenRevisiSidangSkripsiController dengan prefix
    Route::group(['prefix' => 'dosen/revisi_sidang_skripsi'], function () {
        Route::get('/', [DosenRevisiSidangSkripsiController::class, 'index'])->name('dosen-revisi-semhas.index'); // Rute untuk melihat revisi sidang skripsi
        Route::post('/tambahrevisi', [DosenRevisiSidangSkripsiController::class, 'tambahrevisi'])->name('dosen-revisi-semhas.tambahrevisi'); // Rute untuk menambah revisi sidang skripsi
        Route::get('/detail/{id}', [DosenRevisiSidangSkripsiController::class, 'detail'])->name('dosen-revisi-semhas.detail'); // Rute untuk melihat detail revisi sidang skripsi
        Route::post('/accrevisi/{id}', [DosenRevisiSidangSkripsiController::class, 'accrevisi'])->name('dosen-revisi-semhas.acc'); // Rute untuk acc revisi sidang skripsi
        Route::post('/addrevisi/{id}', [DosenRevisiSidangSkripsiController::class, 'addrevisi'])->name('dosen-revisi-semhas.detail'); // Rute untuk menambah revisi sidang skripsi
    });

    // Grup rute untuk DosenRevisiSeminarProposal dengan prefix
    Route::group(['prefix' => 'dosen/revisi_seminar_proposal'], function () {
        Route::get('/', [DosenRevisiSeminarProposal::class, 'index'])->name('dosen-revisi-sempro.index'); // Rute untuk melihat revisi seminar proposal
        Route::post('/tambahrevisi', [DosenRevisiSeminarProposal::class, 'tambahrevisi'])->name('dosen-revisi-sempro.tambahrevisi'); // Rute untuk menambah revisi seminar proposal
        Route::get('/detail/{id}', [DosenRevisiSeminarProposal::class, 'detail'])->name('dosen-revisi-sempro.detail'); // Rute untuk melihat detail revisi seminar proposal
        Route::post('/accrevisi/{id}', [DosenRevisiSeminarProposal::class, 'accrevisi'])->name('dosen-revisi-sempro.acc'); // Rute untuk acc revisi seminar proposal
        Route::post('/addrevisi/{id}', [DosenRevisiSeminarProposal::class, 'addrevisi'])->name('dosen-revisi-add.detail'); // Rute untuk menambah revisi seminar proposal
    });

    // Grup rute untuk HistoryController
    Route::controller(HistoryController::class)->group(function () {
        // Rute untuk mendapatkan notifikasi
        Route::get('/notifications', 'notifications')->name('notifications');
    });

    // Grup rute untuk KoordinatorController
    Route::controller(KoordinatorController::class)->group(function () {
        // Rute untuk halaman dashboard koordinator
        Route::get('/koordinator', 'index')->name('dashboard:koordinator');
    });

    // Grup rute untuk MataKuliahPendukungController dengan prefix
    Route::group(['prefix' => 'koordinator/mata_kuliah_pendukung'], function () {
        // Rute untuk melihat daftar mata kuliah pendukung
        Route::get('/', [MataKuliahPendukungController::class, 'index'])->name('mata-kuliah.index');
        // Rute untuk membuka form pembuatan mata kuliah pendukung baru
        Route::get('/create', [MataKuliahPendukungController::class, 'create'])->name('mata-kuliah.create');
        // Rute untuk menyimpan mata kuliah pendukung baru
        Route::post('/create', [MataKuliahPendukungController::class, 'store'])->name('mata-kuliah.store');
    });

    // Grup rute untuk KoordinatorLaporanTahunanController
    Route::controller(KoordinatorLaporanTahunanController::class)->group(function () {
        // Rute untuk melihat laporan tahunan koordinator
        Route::get('/koordinator/laporan_tahunan', 'index')->name('lap-tahunan.index');
    });

    // Grup rute untuk BidangIlmuController
    Route::controller(BidangIlmuController::class)->group(function () {
        // Rute untuk melihat daftar bidang ilmu
        Route::get('/koordinator/bidang_ilmu', 'index')->name('bidang-ilmu.index');
        // Rute untuk membuka form pembuatan bidang ilmu baru
        Route::get('/koordinator/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        // Rute untuk menyimpan bidang ilmu baru
        Route::post('/koordinator/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
        // Rute untuk melihat detail bidang ilmu
        Route::get('/koordinator/bidang_ilmu/detail/{id}', 'detail')->name('bidang-ilmu.detail');
    });

    // Grup rute untuk DataPenggunaController
    Route::controller(DataPenggunaController::class)->group(function () {
        // Rute untuk melihat data pengguna
        Route::get('/koordinator/data_pengguna', 'index')->name('data-pengguna.index');
        // Rute untuk melihat data mahasiswa
        Route::get('/koordinator/data_pengguna/mahasiswa', 'mhs')->name('data-pengguna-mhs.index');
        // Rute untuk melihat data dosen
        Route::get('/koordinator/data_pengguna/dosen', 'dosen')->name('data-pengguna-dosen.index');
        // Rute untuk melihat data ketua jurusan
        Route::get('/koordinator/data_pengguna/ketua_jurusan', 'kajur')->name('data-pengguna-kajur.index');
        // Rute untuk melihat data pengguna baru
        Route::get('/koordinator/data_pengguna/pengguna_baru', 'newuser')->name('data-pengguna-penggunabaru.index');
        // Rute untuk menerima pengguna baru
        Route::post('/koordinator/data_pengguna/pengguna_baru/terima/{id}', 'terima')->name('terima-pengguna');
        // Rute untuk menolak pengguna baru
        Route::post('/koordinator/data_pengguna/pengguna_baru/tolak/{id}', 'tolak')->name('tolak-pengguna');
    });

    // Grup rute untuk PenjadwalanKoordinatorController
    Route::controller(PenjadwalanKoordinatorController::class)->group(function () {
        // Rute untuk melihat penjadwalan koordinator
        Route::get('/koordinator/penjadwalan', 'index')->name('penjadwalan-koordinator.index');
    });

    // Grup rute untuk KoordinatorBeritaAcaraProposalController dengan prefix
    Route::group(['prefix' => 'koordinator/berita_acara_proposal'], function () {
        // Rute untuk melihat berita acara proposal
        Route::get('/', [KoordinatorBeritaAcaraProposalController::class, 'index'])->name('koor-berita-acara-proposal.index');
        // Rute untuk melihat detail berita acara proposal
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraProposalController::class, 'detail'])->name('koor-berita-acara-proposal.detail');
        // Rute untuk mencetak revisi berita acara proposal
        Route::post('/cetak-revisi/{id}', [KoordinatorBeritaAcaraProposalController::class, 'cetakrevisi'])->name('koor-berita-acara-cetak.detail');
    });

    // Grup rute untuk KoordinatorBeritaAcaraSkripsiController dengan prefix
    Route::group(['prefix' => 'koordinator/berita_acara_skripsi'], function () {
        // Rute untuk melihat berita acara skripsi
        Route::get('/', [KoordinatorBeritaAcaraSkripsiController::class, 'index'])->name('koor-berita-acara-skripsi.index');
        // Rute untuk melihat detail berita acara skripsi
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraSkripsiController::class, 'detail'])->name('koor-berita-acara-skripsi.detail');
        // Rute untuk mencetak revisi berita acara skripsi
        Route::post('/cetak-revisi/{id}', [KoordinatorBeritaAcaraSkripsiController::class, 'cetakrevisi'])->name('koor-berita-acara-s-cetak.detail');
    });

    // Grup rute untuk KoordinatorJudulController dengan prefix
    Route::group(['prefix' => 'koordinator/pengajuan_judul'], function () {
        // Rute untuk melihat pengajuan judul
        Route::get('/', [KoordinatorJudulController::class, 'index'])->name('pengajuan-judul.index');
        // Rute untuk melihat detail pengajuan judul
        Route::get('/detail/{id}', [KoordinatorJudulController::class, 'detail'])->name('pengajuan-judul.detail');
        // Rute untuk memperbarui status pengajuan judul
        Route::post('/update-status/{id}', [KoordinatorJudulController::class, 'updatestatus2'])->name('update_status');
        // Rute untuk menolak pengajuan judul
        Route::post('/tolak/{id}', [KoordinatorJudulController::class, 'tolakpengajuan'])->name('pengajuan-judul-tolak');
    });

    // Grup rute untuk RuanganController dengan prefix
    Route::group(['prefix' => 'koordinator/ruangan'], function () {
        // Rute untuk melihat daftar ruangan
        Route::get('/', [RuanganController::class, 'index'])->name('ruangan.index');
        // Rute untuk membuka form pembuatan ruangan baru
        Route::get('/create', [RuanganController::class, 'create'])->name('ruangan.create');
        // Rute untuk menyimpan ruangan baru
        Route::post('/store', [RuanganController::class, 'store'])->name('ruangan.store');
        // Rute untuk membuka form edit ruangan
        Route::get('/edit/{id}', [RuanganController::class, 'edit']);
        // Rute untuk memperbarui data ruangan
        Route::post('/edit/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        // Rute untuk menghapus ruangan
        Route::delete('/delete/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
    });

    // Grup rute untuk KoordinatorSeminarController dengan prefix
    Route::group(['prefix' => 'koordinator/jadwal_seminar_proposal'], function () {
        // Rute untuk melihat jadwal seminar proposal
        Route::get('/', [KoordinatorSeminarController::class, 'index'])->name('jadwal-seminar-proposal.index');
        // Rute untuk melihat detail jadwal seminar proposal
        Route::get('/detail/{id}', [KoordinatorSeminarController::class, 'detail']);
        // Rute untuk memperbarui jadwal seminar proposal
        Route::post('/update-status/{id}', [KoordinatorSeminarController::class, 'updatejadwal'])->name('jadwal-seminar-proposal-update');
        // Rute untuk menolak jadwal seminar proposal
        Route::post('/tolak/{id}', [KoordinatorSeminarController::class, 'tolakjadwal'])->name('jadwal-seminar-proposal-tolak');
        // Rute untuk mencetak berita acara seminar proposal
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSeminarController::class, 'createberitaacara'])->name('cetak-berita-acara');
    });

    // Grup rute untuk KoordinatorSidangSkripsiController dengan prefix
    Route::group(['prefix' => 'koordinator/jadwal_sidang_skripsi'], function () {
        // Rute untuk melihat jadwal sidang skripsi
        Route::get('/', [KoordinatorSidangSkripsiController::class, 'index'])->name('jadwal-sidang-skripsi.index');
        // Rute untuk melihat detail jadwal sidang skripsi
        Route::get('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'detail']);
        // Rute untuk memperbarui jadwal sidang skripsi
        Route::post('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'update'])->name('jadwal-sidang-skripsi-update');
        // Rute untuk menolak jadwal sidang skripsi
        Route::post('/tolak/{id}', [KoordinatorSidangSkripsiController::class, 'tolakjadwal'])->name('jadwal-sidang-skripsi-tolak');
        // Rute untuk mencetak berita acara sidang skripsi
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSidangSkripsiController::class, 'createberitaacara'])->name('cetak-berita-acara-s');
    });

    // Grup rute untuk KoordinatorSuratTugasController dengan prefix
    Route::group(['prefix' => 'koordinator/surat_tugas'], function () {
        // Rute untuk melihat surat tugas
        Route::get('/', [KoordinatorSuratTugasController::class, 'index'])->name('koor-surat-tugas.index');
        // Rute untuk melihat detail surat tugas
        Route::get('/detail/{id}', [KoordinatorSuratTugasController::class, 'detail'])->name('koor-surat-tugas.detail');
        // Rute untuk memperbarui surat tugas
        Route::post('/update/{id}', [KoordinatorSuratTugasController::class, 'update'])->name('koor-surat-tugas.update');
        // Rute untuk melihat file surat tugas
        Route::get('/lihat_file/{id}', [KoordinatorSuratTugasController::class, 'showfile'])->name('koor-surat-tugas.lihat');
        // Rute untuk menolak surat tugas
        Route::post('/tolak/{id}', [KoordinatorSuratTugasController::class, 'tolaksurat'])->name('koor-surat-tugas-tolak');
    });

// });

// Route::group(['middleware' => 'auth:mahasiswa'], function () {
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications');
    });

    Route::get('storage-files/{file}', 'StorageFileController@show')->name('storage-files.show');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


    // Grup rute untuk history bimbingan proposal
    Route::group(['prefix' => 'history_bimbingan_proposal'], function () {
        // Rute untuk melihat history bimbingan proposal
        Route::get('/', [HistoryBimbinganController::class, 'index'])->name('his-bim-mhs.index');
    });

    // Grup rute untuk history bimbingan skripsi
    Route::group(['prefix' => 'history_bimbingan_skripsi'], function () {
        // Rute untuk melihat history bimbingan skripsi
        Route::get('/', [HistoryBimbinganSkripsiController::class, 'index'])->name('his-bims-mhs.index');
    });

    // Grup rute untuk surat survey perusahaan
    Route::group(['prefix' => 'surat_survey_perusahaan'], function () {
        // Rute untuk melihat surat survey
        Route::get('/', [SuratSurveyController::class, 'index'])->name('surat-survey.index');
        // Rute untuk menyimpan surat survey
        Route::post('/', [SuratSurveyController::class, 'store'])->name('surat-survey.store');
    });

    // Grup rute untuk history revisi skripsi
    Route::group(['prefix' => 'history_revisi_skripsi'], function () {
        // Rute untuk melihat history revisi skripsi
        Route::get('/', [HistoryRevisiSkripsiController::class, 'index'])->name('his-rev-mhs.index');
    });

    // Grup rute untuk history revisi seminar
    Route::group(['prefix' => 'history_revisi_seminar'], function () {
        // Rute untuk melihat history revisi seminar
        Route::get('/', [HistoryRevisiProposalController::class, 'index'])->name('his-rev-pro.index');
    });

    // Grup rute untuk profil pengguna
    Route::controller(ProfileController::class)->group(function () {
        // Rute untuk melihat profil
        Route::get('/profile', 'index')->name('profile.index');
        // Rute untuk mengedit profil
        Route::get('/profile/edit/{id}', 'edit');
        // Rute untuk memperbarui profil
        Route::post('/profile/update/{id}', 'store')->name('update-profile.store');
    });

    // Grup rute untuk pengajuan judul
    Route::controller(PengajuanJudulController::class)->group(function () {
        // Rute untuk menyimpan pengajuan judul
        Route::post('/pengajuan_judul', 'store')->name('pengajuan-judul.submit');
        // Rute untuk menampilkan form pengajuan judul
        Route::get('/pengajuan_judul', 'showFormPengajuan')->name('pengajuan-judul.form');
    });

    // Grup rute untuk seminar proposal
    Route::controller(SeminarProposalController::class)->group(function () {
        // Rute untuk membuat seminar proposal
        Route::get('/seminar_proposal', 'create')->name('seminar-proposal.create');
        // Rute untuk menyimpan seminar proposal
        Route::post('/seminar_proposal', 'store')->name('seminar-proposal.submit');
        // Rute untuk memeriksa status seminar proposal
        Route::get('/seminar_proposal/check-status', 'checkStatus')->name('seminar-proposal.check');
        // Rute untuk menampilkan status seminar proposal
        Route::get('/seminar_proposal/status/{id}', 'showStatus')->name('status.show');
        // Rute untuk menampilkan form submit
        Route::get('/submit-form', 'create')->name('submit-form');
    });

    // Grup rute untuk bimbingan proposal
    Route::controller(BimbinganProposalController::class)->group(function (){
        // Rute untuk melihat bimbingan proposal
        Route::get('/bimbingan_proposal', 'index')->name('bimbingan-mhs.index');
        // Rute untuk menyimpan bimbingan proposal
        Route::post('/bimbingan_proposal', 'store')->name('bimbingan-mhs.store');
    });

    // Grup rute untuk bimbingan skripsi
    Route::group(['prefix' => '/bimbingan_skripsi'], function() {
        // Rute untuk melihat bimbingan skripsi
        Route::get('/', [BimbinganSkripsiController::class, 'index'])->name('bimbingans-mhs.index');
        // Rute untuk menyimpan bimbingan skripsi
        Route::post('/store', [BimbinganSkripsiController::class, 'store'])->name('bimbingans-mhs.store');
    });

    // Grup rute untuk revisi seminar proposal
    Route::group(['prefix' => '/revisi_seminar_proposal'], function () {
        // Rute untuk melihat revisi seminar proposal
        Route::get('/', [RevisiSeminarProposalController::class, 'index'])->name('revisi_sp.index');
        // Rute untuk menyimpan revisi seminar proposal
        Route::post('/store', [RevisiSeminarProposalController::class, 'store'])->name('revisi_sp.store');
    });

    // Grup rute untuk revisi sidang skripsi
    Route::group(['prefix' => '/revisi_sidang_skripsi'], function () {
        // Rute untuk melihat revisi sidang skripsi
        Route::get('/', [RevisiSidangSkripsiController::class, 'index'])->name('revisi_sk.index');
        // Rute untuk menyimpan revisi sidang skripsi
        Route::post('/store', [RevisiSidangSkripsiController::class, 'store'])->name('revisi_sk.store');
    });

    // Grup rute untuk sidang skripsi
    Route::group(['prefix' => '/sidang_skripsi'], function () {
        // Rute untuk melihat sidang skripsi
        Route::get('/', [SidangSkripsiController::class, 'index'])->name('sidang_skripsi.index');
        // Rute untuk menyimpan sidang skripsi
        Route::post('/store', [SidangSkripsiController::class, 'store'])->name('sidang_skripsi.store');
        // Rute untuk memeriksa status sidang skripsi
        Route::get('/check-status', [SidangSkripsiController::class, 'checkStatus'])->name('sidang-skripsi.check');
        // Rute untuk menampilkan status sidang skripsi
        Route::get('/status/{id}', [SidangSkripsiController::class, 'showStatus'])->name('sidang-skripsi.status');
        // Rute untuk menampilkan form submit
        Route::get('/submit-form', [SidangSkripsiController::class, 'index'])->name('sidang-skripsi.store');
    });

    // Grup rute untuk surat tugas
    Route::controller(SuratTugasController::class)->group(function (){
        // Rute untuk melihat surat tugas
        Route::get('/surat_tugas', 'index')->name('pengajuan-st.index');
        // Rute untuk menyimpan surat tugas
        Route::post('/surat_tugas', 'store')->name('pengajuan-st.store');
        // Rute untuk memeriksa status surat tugas
        Route::get('/surat_tugas/check-status', 'checkStatus')->name('pengajuan-st.check');
        // Rute untuk menampilkan status surat tugas
        Route::get('/surat_tugas/status/{id}', 'showStatus')->name('pengajuan-st.show');
        // Rute untuk menampilkan form submit
        Route::get('/submit-form', 'create')->name('pengajuan-st.submit-form');
    });

    // Grup rute untuk FAQ
    Route::controller(FAQController::class)->group(function () {
        // Rute untuk halaman FAQ
        Route::get('/faq', 'index')->name('faq');
    });

    // Rute fallback untuk halaman 404
    Route::fallback(function () {
        return view('404'); // Gantilah 'errors.404' dengan nama view yang sesuai untuk halaman 404 Anda
    });

// });
