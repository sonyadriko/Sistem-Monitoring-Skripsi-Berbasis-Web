<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoordinatorSidangSkripsiController extends Controller
{
    public function index()
    {
        // $sempros = SeminarProposal::all();
        $semhas = DB::table('sidang_skripsi')->join('users', 'users.id', 'sidang_skripsi.users_id')->get();

        return view('koordinator/penjadwalan/sidang_skripsi.index', compact('semhas'));

    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('sidang_skripsi')
                ->join('users', 'users.id', 'sidang_skripsi.users_id')
                ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_sidang_skripsi', '=', $id)->first(),
        ];
        // dd($data);

        $baru = [
            'baru' => DB::table('users')->where('role_id', '2')->get(),
        ];
        return view('koordinator/penjadwalan/sidang_skripsi.detail', $data, $baru);

    }
}
