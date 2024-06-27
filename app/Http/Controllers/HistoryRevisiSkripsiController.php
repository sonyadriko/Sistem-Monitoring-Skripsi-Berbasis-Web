<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryRevisiSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {
        $userId = Auth::user()->id; // Menyimpan user ID ke dalam variabel untuk memudahkan penggunaan

        $hisbimmhs = DB::table('detail_revisi_sidang_skripsi')
        ->join('revisi_sidang_skripsi', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi', 'detail_revisi_sidang_skripsi.revisi_sidang_skripsi_id')
        ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
        // ->select('detail_bimbingan_skripsi.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'bimbingan_proposal.dosen_pembimbing_utama',  'bimbingan_proposal.dosen_pembimbing_ii')
        ->where('users.id', $userId) // Menambahkan kondisi where untuk userID
        ->get();

        // $dethisbimmhs = DB::table('bimbingan_skripsi')
        // ->join('users', 'users.id', 'bimbingan_skripsi.users_id')
        // ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        // ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        // ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
        // ->where('users.id', $userId) // Menambahkan kondisi where untuk userID
        // ->get();
        $dethisbimmhs = DB::table('bimbingan_proposal')
            ->join('users', 'users.id', '=', 'bimbingan_proposal.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', '=', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', '=', 'bimbingan_proposal.pengajuan_id')
            ->select('bimbingan_proposal.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'pengajuan_judul.judul')
            ->where('users.id', $userId)
            ->get();
        return view('mahasiswa/skripsi/history_revisi.index', compact('hisbimmhs', 'dethisbimmhs'));
    }
}