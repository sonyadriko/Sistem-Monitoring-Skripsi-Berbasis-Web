<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RevisiSeminarProposalController extends Controller
{
    //
    public function index()
    {

        $revisisp = DB::table('detail_berita_acara_proposal')
        ->select('detail_berita_acara_proposal.*', 'berita_acara_proposal.id_berita_acara_p', 'users.*')
        ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', '=', 'detail_berita_acara_proposal.berita_acara_proposal_id')
        ->join('users', 'users.id', '=', 'detail_berita_acara_proposal.users_id')
        ->where('berita_acara_proposal.users_id', Auth::user()->id)
        ->get();
    
    

        return view('mahasiswa/proposal/revisi.index', compact('revisisp')) ;

    }
}
