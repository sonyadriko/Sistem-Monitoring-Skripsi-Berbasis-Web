<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BimbinganProposal as BimbinganProposal;
use Illuminate\Support\Facades\DB;

class DosenBimbinganProposalController extends Controller
{
    
    public function index()
    {
        // $juduls = Judul::all();
        $juduls = DB::table('bimbingan_proposal');
       
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }

}
