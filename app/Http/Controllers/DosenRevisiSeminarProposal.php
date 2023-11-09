<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenRevisiSeminarProposal extends Controller
{
    public function index()
    {
        $rev = DB::table('revisi_seminar_proposal')
        ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'revisi_seminar_proposal.berita_acara_proposal_id')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->where(function($query) {
            $query->where('seminar_proposal.dosen_penguji_1', '=', Auth::user()->id)
                  ->orWhere('seminar_proposal.dosen_penguji_2', '=', Auth::user()->id);
        })
        ->get();
        return view('dosen/revisi/proposal.index', compact('rev'));
    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('revisi_seminar_proposal')
                    ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'revisi_seminar_proposal.berita_acara_proposal_id')
                    ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                    ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')

                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')

                    // ->select('bimbingan_proposal.*', 'users.*', 'bidang_ilmu.topik_bidang_ilmu')
                    ->where('id_revisi_seminar_proposal', '=',$id)->first(),
            'detail' => DB::table('revisi_seminar_proposal')->where('id_revisi_seminar_proposal', '=',$id)->get(),
        ];

        return view('dosen/revisi/proposal.detail', ['data' => $data['data'], 'detail' => $data['detail']]);
        // return view('dosen/revisi/proposal.detail', ['data' => $data['data']]);


    }
}
