<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KoordinatorSuratTugasController extends Controller
{
    //
    public function index()
    {
        $surattugas = DB::table('surat_tugas')->join('users', 'users.id', 'surat_tugas.user_id')->get();
     
        return view('koordinator/surat_tugas.index', compact('surattugas'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('surat_tugas')
                ->join('users', 'users.id', 'surat_tugas.user_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'surat_tugas.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->join('seminar_proposal', 'seminar_proposal.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
                ->where('id_surat_tugas', $id)
                ->first(),
        ];

        return view('koordinator/surat_tugas.detail', $data);

    }
}
