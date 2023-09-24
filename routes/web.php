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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('storage-files/{file}', 'StorageFileController@show')->name('storage-files.show');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    
    Route::get('/proposal', function () {
        return view('mahasiswa/proposal/index');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit/{id}', 'edit');
        Route::post('/profile/update/{id}', 'store')->name('update-profile.store');

    });
    
    Route::controller(PengajuanJudulController::class)->group(function () {
        Route::get('/proposal/pengajuan_judul', 'create')->name('pengajuan-judul.create');
        Route::post('/proposal/pengajuan_judul', 'store')->name('pengajuan-judul.submit');
        // Route::match(['get','post'], 'koordinator/updatedetail/{id}');
    });
    
    Route::controller(KoordinatorJudulController::class)->group(function () {
        Route::get('/koordinator/pengajuan_judul', 'index')->name('pengajuan-judul.index');
        Route::get('/koordinator/pengajuan_judul/detail/{id}', 'detail');
        Route::post('/koordinator/pengajuan_judul/update-status/{id_tema}', 'updatestatus2')->name('update_status');
        // Route::post('/koordinator/pengajuan_judul/updatedetail/{id}', 'updatestatus'); 
    });
    
    Route::controller(KoordinatorSeminarController::class)->group(function () {
        Route::get('/koordinator/jadwal_seminar_proposal', 'index')->name('jadwal-seminar-proposal.index');
        Route::get('/koordinator/jadwal_seminar_proposal/detail/{id}', 'detail');
        Route::post('/koordinator/jadwal_seminar_proposal/update-status/{id}', 'updatejadwal')->name('jadwal-seminar-proposal-update');
        Route::post('/koordinator/jadwal_seminar_proposal/cetak-berita-acara/{id}', 'createberitaacara')->name('cetak-berita-acara');
    }); 
    
    
    Route::controller(BidangIlmuController::class)->group(function () {
        Route::get('/dosen/bidang_ilmu', 'index')->name('bidang-ilmu.index');
        Route::get('/dosen/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        Route::post('/dosen/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
    });
    
    Route::controller(SeminarProposalController::class)->group(function ()
    {
        Route::get('/proposal/seminar_proposal', 'create')->name('seminar-proposal.create');
        Route::post('/proposal/seminar_proposal', 'store')->name('seminar-proposal.submit');
    
    });
    
    Route::controller(PembagianDosenController::class)->group(function () 
    { 
        Route::get('/koordinator/pembagian_dosen', 'index')->name('pembagian-dosen.create');
        Route::get('/koordinator/pembagian_dosen/edit/{id}', 'edit');
        Route::post('/koordinator/pembagian_dosen/store', 'store')->name('pembagian-dosen.store');
    }); 

    Route::controller(BimbinganProposalController::class)->group(function (){
        Route::get('/proposal/bimbingan', 'index')->name('bimbingan-mhs.index');
        Route::post('/proposal/bimbingan', 'store')->name('bimbingan-mhs.store');
    });
  
    Route::group(['prefix' => 'dosen/bimbingan_proposal'], function () {
        Route::get('/', [DosenBimbinganProposalController::class, 'index'])->name('bimbingan-dosen.index');
        Route::get('/detail/{id}', [DosenBimbinganProposalController::class, 'detail'])->name('bimbingan-dosen.detail');
        Route::post('/updaterevisi/{id}', [DosenBimbinganProposalController::class, 'updaterevisi'])->name('bimbingan-dosen.addrevisi');
        Route::post('/accrevisi/{id}', [DosenBimbinganProposalController::class, 'accrevisi'])->name('bimbingan-dosen.accrevisi');
        Route::post('/accproposal/{id}', [DosenBimbinganProposalController::class, 'accproposal'])->name('bimbingan-dosen.accproposal');
    });

    Route::controller(SuratTugasController::class)->group(function (){
        Route::get('/proposal/surat_tugas', 'index')->name('pengajuan-st.index');
        Route::post('/proposal/surat_tugas', 'store')->name('pengajuan-st.store');
    });

    Route::controller(KoordinatorSuratTugasController::class)->group(function (){
        Route::get('/koordinator/surat_tugas', 'index');
    });
    Route::group(['prefix' => 'dosen/berita_acara_proposal'], function () {
        Route::get('/', [BeritaAcaraProposalController::class, 'index'])->name('berita-acara-proposal.index');
        Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');

    });

   
});

