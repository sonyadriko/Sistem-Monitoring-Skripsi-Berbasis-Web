<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratSurveyController extends Controller
{
    //
    public function index()
    {
        $ss = DB::table('bimbingan_proposal')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->where('bimbingan_proposal.user_id', Auth::user()->id)
            ->first();

        return view('mahasiswa/surat_survey.index', compact('ss'));
    }
    public function store(Request $request)
    {

    }
}
