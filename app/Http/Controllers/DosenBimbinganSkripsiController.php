<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\DetailBimbinganProposal as DetailBimbinganProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DOsenBimbinganSkripsiController extends Controller
{
    public function index()
    {
        $bimbingans = DB::table('bimbingan_skripsi')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                ->join('tema', 'tema.id_tema', 'bimbingan_proposal.tema_id')
                ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where(function($query) {
                    $query->where('dosen_pembimbing_utama', Auth::user()->name)
                          ->orWhere('dosen_pembimbing_ii', Auth::user()->name);
                })
                ->orderBy('bimbingan_skripsi.created_at', 'desc')
                ->get();
        return view('dosen/bimbingan/skripsi.index', compact('bimbingans'));


    }
}
