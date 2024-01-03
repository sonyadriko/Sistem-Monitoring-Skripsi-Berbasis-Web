<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KoordinatorYudisiumController extends Controller
{
    public function index()
    {
        $yudisium = DB::table('yudisium')
        ->join('users', 'users.id', 'yudisium.users_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->latest('yudisium.created_at')
        ->get();

        return view('koordinator/yudisium.index', compact('yudisium'));
    }
}
