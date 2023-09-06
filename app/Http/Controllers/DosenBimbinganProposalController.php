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
        // $juduls = Judul::all();
        $dosens = DB::table('dosen')
            ->join('users', 'users.id', 'dosen.user_id')
            ->join('tema', 'tema.id_tema', 'dosen.tema_id')
            // ->join('bimbingan_proposal', 'bimbingan_proposal.dosen_id', 'dosen.id_dosen')
            ->where(function($query) {
                $query->where('dospem_1', '=', Auth::user()->id)
                    ->orWhere('dospem_2', '=', Auth::user()->id);
            })
            ->orderBy('dosen.created_at', 'desc')
            ->get();
        return view('dosen/bimbingan/proposal.index', compact('dosens'));
       

    }

}
