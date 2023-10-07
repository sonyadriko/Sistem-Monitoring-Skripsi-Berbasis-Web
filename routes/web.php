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

// Route::controller 
Route::controller(LoginController::class)->group(function () {
    Route::get('/auth-login', 'showLoginForm')
        ->name('auth-login')
        ->middleware('guest');
    Route::post('/auth-login', 'login')->name('auth');
    Route::get('/auth-logout', 'logout')->name('auth-logout');
    // Route::get('/reset-auth-logout', 'password_reset_logout')->name('reset-auth-logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')
    ->name('register')
    ->middleware('guest');
    // Route::post('/register', 'create')->name('regist');

});


Route::group(['middleware' => 'auth:dosen'], function() {

    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'index')->name('dashboard:dosen');
    });


    Route::controller(BidangIlmuController::class)->group(function () {
        Route::get('/dosen/bidang_ilmu', 'index')->name('bidang-ilmu.index');
        Route::get('/dosen/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        Route::post('/dosen/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
    });

    Route::group(['prefix' => 'dosen/bimbingan_proposal'], function () {
        Route::get('/', [DosenBimbinganProposalController::class, 'index'])->name('bimbingan-dosen.index');
        Route::get('/detail/{id}', [DosenBimbinganProposalController::class, 'detail'])->name('bimbingan-dosen.detail');
        Route::post('/updaterevisi/{id}', [DosenBimbinganProposalController::class, 'updaterevisi'])->name('bimbingan-dosen.addrevisi');
        Route::post('/accrevisi/{id}', [DosenBimbinganProposalController::class, 'accrevisi'])->name('bimbingan-dosen.accrevisi');
        Route::post('/accproposal/{id}', [DosenBimbinganProposalController::class, 'accproposal'])->name('bimbingan-dosen.accproposal');
    });
    Route::group(['prefix' => 'dosen/berita_acara_proposal'], function () {
        Route::get('/', [BeritaAcaraProposalController::class, 'index'])->name('berita-acara-proposal.index');
        Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');
    });
});

Route::group(['middleware' => 'auth:koordinator'], function() {

    Route::controller(KoordinatorController::class)->group(function () {
        Route::get('/koordinator', 'index')->name('dashboard:koordinator');
    });

    Route::group(['prefix' => 'koordinator/berita_acara_proposal'], function () {
        Route::get('/', [KoordinatorBeritaAcaraProposalController::class, 'index'])->name('koor-berita-acara-proposal.index');
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraProposalController::class, 'detail'])->name('koor-berita-acara-proposal.detail');

    });

    Route::group(['prefix' => 'koordinator/pengajuan_judul'], function () {
        Route::get('/', [KoordinatorJudulController::class, 'index'])->name('pengajuan-judul.index');
        Route::get('/detail/{id}', [KoordinatorJudulController::class, 'detail']);
        Route::post('/update-status/{id_tema}', [KoordinatorJudulController::class, 'updatestatus2'])->name('update_status');
    });
    
    Route::group(['prefix' => 'koordinator/jadwal_seminar_proposal'], function () {
        Route::get('/', [KoordinatorSeminarController::class, 'index'])->name('jadwal-seminar-proposal.index');
        Route::get('/detail/{id}', [KoordinatorSeminarController::class, 'detail']);
        Route::post('/update-status/{id}', [KoordinatorSeminarController::class, 'updatejadwal'])->name('jadwal-seminar-proposal-update');
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSeminarController::class, 'createberitaacara'])->name('cetak-berita-acara');
    });
    

    Route::group(['prefix' => 'koordinator/surat_tugas'], function () {
        Route::get('/', [KoordinatorSuratTugasController::class, 'index'])->name('koor-surat-tugas.index');
        Route::get('/detail/{id}', [KoordinatorSuratTugasController::class, 'detail'])->name('koor-surat-tugas.detail');
        Route::post('/update/{id}', [KoordinatorSuratTugasController::class, 'update'])->name('koor-surat-tugas.update');
    });

    Route::controller(PembagianDosenController::class)->group(function () 
    { 
        Route::get('/koordinator/pembagian_dosen', 'index')->name('pembagian-dosen.create');
        Route::get('/koordinator/pembagian_dosen/edit/{id}', 'edit');
        Route::post('/koordinator/pembagian_dosen/store', 'store')->name('pembagian-dosen.store');
    }); 

    
});

Route::group(['middleware' => 'auth:mahasiswa,dosen,koordinator,ketuajurusan'], function () {

    Route::get('storage-files/{file}', 'StorageFileController@show')->name('storage-files.show');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    
    Route::get('/proposal', function () {
        return view('mahasiswa/proposal/index');
    })->name('proposal');
    

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
    
    
    Route::controller(SeminarProposalController::class)->group(function ()
    {
        Route::get('/proposal/seminar_proposal', 'create')->name('seminar-proposal.create');
        Route::post('/proposal/seminar_proposal', 'store')->name('seminar-proposal.submit');
    
    });
    
   
    Route::controller(BimbinganProposalController::class)->group(function (){
        Route::get('/proposal/bimbingan', 'index')->name('bimbingan-mhs.index');
        Route::post('/proposal/bimbingan', 'store')->name('bimbingan-mhs.store');
    });
  
    

    Route::controller(SuratTugasController::class)->group(function (){
        Route::get('/proposal/surat_tugas', 'index')->name('pengajuan-st.index');
        Route::post('/proposal/surat_tugas', 'store')->name('pengajuan-st.store');
    });

    

   
});

