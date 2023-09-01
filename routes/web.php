<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\PengajuanJudulController;
use App\Http\Controllers\BidangIlmuController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::get('/proposal', function () {
    return view('mahasiswa/proposal/index');
});

Route::controller(PengajuanJudulController::class)->group(function () {
    Route::get('/koordinator/pengajuan_judul', 'index')->name('pengajuan-judul.index');
    Route::get('/proposal/pengajuan_judul', 'create')->name('pengajuan-judul.create');
    Route::post('/proposal/pengajuan_judul', 'store')->name('pengajuan-judul.submit');
    Route::get('/koordinator/getdetail/{id}', 'getDetail');
    Route::post('/koordinator/updatedetail/{id}', 'updatestatus');
});

Route::controller(BidangIlmuController::class)->group(function () {
    Route::get('/dosen/bidang_ilmu', 'index')->name('bidang-ilmu');
    Route::post('/dosen/bidang_ilmu', 'store')->name('bidang-ilmu.submit');
});

Route::controller(SeminarProposalController::class)->group(function ()
{
    Route::get('/proposal/seminar_proposal', 'create')->name('seminar-proposal.create');
    Route::post('/proposal/seminar_proposal', 'store')->name('seminar-proposal.submit');

});
// Route::get('/koordinator/pengajuan_judul_proposal', function (){
//     return view('koordinator/pengajuan_judul_proposal/index');
// })->name('pengajuan_judul_proposal');
Route::get('/koordinator/pembagian_dosen', function (){
    return view('koordinator/pembagian_dosen/index');
})->name('pembagian_dosen');
Route::get('/koordinator/jadwal_seminar_proposal', function (){
    return view('koordinator/penjadwalan/seminar_proposal/index');
})->name('jadwal_seminar_proposal');
Route::get('/dosen/berita_acara_seminar', function (){
    return view('dosen/berita_acara/seminar/index');
})->name('berita_acara_seminar');