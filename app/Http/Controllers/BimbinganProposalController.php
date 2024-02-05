<?php

namespace App\Http\Controllers;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\DetailBimbinganProposal as DetailBimbinganProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BimbinganProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {
        $dosens = DB::table('bimbingan_proposal')
        ->where('users_id', Auth::user()->id)
        ->first();

        $detailbim = DB::table('detail_bimbingan_proposal')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'detail_bimbingan_proposal.bimbingan_proposal_id')
            ->where('users_id', Auth::user()->id)
            ->latest('detail_bimbingan_proposal.created_at') // Order by the creation timestamp in descending order
            ->first();

        return view('mahasiswa/proposal/bimbingan.index', compact('dosens', 'detailbim'));


    }




}
