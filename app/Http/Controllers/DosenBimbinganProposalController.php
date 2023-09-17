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
        $bimbinganp = DB::table('bimbingan_proposal')
                ->join('tema', 'tema.id_tema', 'bimbingan_proposal.tema_id')
                ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where(function($query) {
                    $query->where('dosen_pembimbing_utama', Auth::user()->name)
                          ->orWhere('dosen_pembimbing_ii', Auth::user()->name);
                })
                ->orderBy('bimbingan_proposal.created_at', 'desc')
                ->get();
        return view('dosen/bimbingan/proposal.index', compact('bimbinganp'));
       

    }
            
    public function detail($id)
    {
        $data = [
            'data' => DB::table('bimbingan_proposal')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                    ->select('bimbingan_proposal.*', 'users.*', 'bidang_ilmu.topik_bidang_ilmu')
                    ->where('id_bimbingan_proposal', '=',$id)->first(), 
        ];
        // $data = [
        //     'data' => DB::table('bimbingan_proposal')->where('id_bimbingan_proposal', '=',$id)->first()
        // ];
        return view('dosen/bimbingan/proposal.detail', ['data' => $data['data']]);
        // return view('dosen/bimbingan/proposal.detail', compact('data'));

    }
}

