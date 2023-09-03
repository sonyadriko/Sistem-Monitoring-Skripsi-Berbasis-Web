<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeminarProposal as SeminarProposal;
use Illuminate\Support\Facades\DB;

class KoordinatorSeminarController extends Controller
{
    public function index()
    {
        $sempros = SeminarProposal::all();
     
        return view('koordinator/penjadwalan/seminar_proposal.index', compact('sempros'));

    }

    public function detail($id)
    {
       
        $data = [
            'data' => DB::table('seminar_proposal')->where('id', '=',$id)->first(),
            // 'bidang_ilmu' => DB::table('bidang_ilmu')->select('id', 'topik_bidang_ilmu')->get(),
        ];
       
        return view('koordinator/penjadwalan/seminar_proposal.detail', $data);

    }
}
