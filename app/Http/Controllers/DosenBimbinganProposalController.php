<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BimbinganProposal as BimbinganProposal;
use Illuminate\Support\Facades\DB;

class DosenBimbinganProposalController extends Controller
{
    
    public function index()
    {
        // $dosens = DB::table('tema')
        //     ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')
        //     ->join('users', 'users.id', 'tema.user_id')
        //     ->where('tema.status', 'terima')
        //     ->where('bidang_ilmu.user_id', Auth::user()->id)
        //     ->orderBy('tema.created_at', 'desc')
        //     ->get();
        // return view('dosen/bimbingan/proposal.index', compact('dosens'));
        $bimbinganp = DB::table('bimbingan_proposal')
                ->join('tema', 'tema.id_tema', 'bimbingan_proposal.tema_id')
                ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                ->where(function($query) {
                    $query->where('dosen_pembimbing_utama', Auth::user()->name)
                          ->orWhere('dosen_pembimbing_ii', Auth::user()->name);
                })
                ->orderBy('bimbingan_proposal.created_at', 'desc')
                ->get();
        return view('dosen/bimbingan/proposal.index', compact('bimbinganp'));
       

    }
// ->join('bimbingan_proposal', 'bimbingan_proposal.dosen_id', 'dosen.id_dosen')
            // ->where(function($query) {
            //     $query->where('status', '=', Auth::user()->id)
            //         ->orWhere('dospem_2', '=', Auth::user()->id);
            // })
            
    public function detail()
    {
        return view('dosen/bimbingan/proposal.detail');

    }
}

