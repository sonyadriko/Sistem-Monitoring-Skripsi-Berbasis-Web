<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RevisiSeminarProposal as RevisiSeminarProposal;
use App\Models\DetailRevisiSeminarProposal as DetailRevisiSeminarProposal;


class RevisiSeminarProposalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {

        $revisisp = DB::table('berita_acara_proposal')
            ->select(
                'berita_acara_proposal.*',
                'users.name', 'users.id', 'users.kode_unik',
                'revisi_seminar_proposal.*',
            )
            ->join('detail_berita_acara_proposal', 'detail_berita_acara_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
            ->join('users', 'users.id', 'berita_acara_proposal.users_id')
            ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
            ->where('berita_acara_proposal.users_id', Auth::user()->id)
            ->first();
        $revisisp2 = DB::table('detail_berita_acara_proposal')
            ->select('detail_berita_acara_proposal.*', 'berita_acara_proposal.id_berita_acara_p', 'users.*')
            ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'detail_berita_acara_proposal.berita_acara_proposal_id')
            ->join('users', 'users.id', 'detail_berita_acara_proposal.users_id')
            ->where('berita_acara_proposal.users_id', Auth::user()->id)
            ->get();

        $detailrev = DB::table('detail_revisi_seminar_proposal')
            ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.id_revisi_seminar_proposal', '=', 'detail_revisi_seminar_proposal.revisi_seminar_proposal_id')
            ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', '=', 'revisi_seminar_proposal.berita_acara_proposal_id')
            ->join('users', 'users.id', '=', 'detail_revisi_seminar_proposal.users_id')
            ->select('berita_acara_proposal.users_id', 'detail_revisi_seminar_proposal.revisi', DB::raw('GROUP_CONCAT(DISTINCT users.name) as unique_names'))
            ->groupBy('berita_acara_proposal.users_id', 'detail_revisi_seminar_proposal.revisi')
            ->get();

        $latestRevisions = DB::table('detail_revisi_seminar_proposal')
            ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.id_revisi_seminar_proposal', '=', 'detail_revisi_seminar_proposal.revisi_seminar_proposal_id')
            ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', '=', 'revisi_seminar_proposal.berita_acara_proposal_id')
            ->join('users', 'users.id', '=', 'detail_revisi_seminar_proposal.users_id')
            ->select('berita_acara_proposal.users_id', 'detail_revisi_seminar_proposal.revisi', DB::raw('GROUP_CONCAT(DISTINCT users.name) as unique_names'), 'detail_revisi_seminar_proposal.id_detail_revisi_seminar')
            ->groupBy('berita_acara_proposal.users_id', 'detail_revisi_seminar_proposal.revisi', 'detail_revisi_seminar_proposal.id_detail_revisi_seminar')
            ->get();

        return view('mahasiswa/proposal/revisi.index', compact('revisisp', 'revisisp2', 'detailrev', 'latestRevisions')) ;

    }
}
