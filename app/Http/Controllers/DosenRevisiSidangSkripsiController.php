<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenRevisiSidangSkripsiController extends Controller
{
    public function index()
    {
        $rev = DB::table('revisi_sidang_skripsi')
        ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->where(function($query) {
            $query->where('sidang_skripsi.dosen_penguji_1', '=', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_2', '=', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_3', '=', Auth::user()->id);

        })
        ->get();
        return view('dosen/revisi/skripsi.index', compact('rev'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('revisi_sidang_skripsi')
                    ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
                    ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
                    ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
                    ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')

                    // ->select('bimbingan_proposal.*', 'users.*', 'bidang_ilmu.topik_bidang_ilmu')
                    ->where('id_revisi_sidang_skripsi', '=',$id)->first(),
            'detail' => DB::table('revisi_sidang_skripsi')->where('id_revisi_sidang_skripsi', '=',$id)->get(),
        ];

        return view('dosen/revisi/skripsi.detail', ['data' => $data['data'], 'detail' => $data['detail']]);
        // return view('dosen/revisi/proposal.detail', ['data' => $data['data']]);


    }
}
