<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryRevisiProposalController extends Controller
{
    public function index()
    {
        $hisbimmhs = DB::table('detail_revisi_seminar_proposal')
        ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.id_revisi_seminar_proposal', 'detail_revisi_seminar_proposal.revisi_seminar_proposal_id')
        ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'revisi_seminar_proposal.berita_acara_proposal_id')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
        // ->select('detail_bimbingan_skripsi.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'bimbingan_proposal.dosen_pembimbing_utama',  'bimbingan_proposal.dosen_pembimbing_ii')
        ->where('users.id', Auth::user()->id) // Menambahkan kondisi where untuk userID
        ->get();
        return view('mahasiswa/proposal/history_revisi.index', compact('hisbimmhs'));
    }
}
