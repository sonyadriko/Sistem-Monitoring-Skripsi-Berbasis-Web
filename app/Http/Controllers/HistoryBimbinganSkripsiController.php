<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryBimbinganSkripsiController extends Controller
{
    public function index()
    {
        $hisbimmhs = DB::table('detail_bimbingan_skripsi')
        ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'detail_bimbingan_skripsi.bimbingan_skripsi_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('users', 'users.id', 'bimbingan_proposal.user_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->select('detail_bimbingan_skripsi.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'bimbingan_proposal.dosen_pembimbing_utama',  'bimbingan_proposal.dosen_pembimbing_ii')
        ->where('users.id', '=', Auth::user()->id) // Menambahkan kondisi where untuk userID
        ->get();
        return view('mahasiswa/skripsi/history_bimbingan.index', compact('hisbimmhs'));
    }
}
