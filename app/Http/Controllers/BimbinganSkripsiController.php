<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailBimbinganSkripsi as DetailBimbinganSkripsi;


class BimbinganSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {

        $bimbingans = DB::table('bimbingan_skripsi')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->select('bimbingan_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii')
        ->where('bimbingan_skripsi.users_id', Auth::user()->id)
        ->first();

        $detailbim = DB::table('detail_bimbingan_skripsi')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'detail_bimbingan_skripsi.bimbingan_skripsi_id')
            ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->where('bimbingan_skripsi.users_id', Auth::user()->id)
            ->latest('detail_bimbingan_skripsi.created_at') // Order by the creation timestamp in descending order
            ->first();

        return view('mahasiswa/skripsi/bimbingan.index', compact('bimbingans', 'detailbim'));
    }


}
