<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataBidangIlmuController extends Controller
{
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $databi = DB::table('bidang_ilmu')
        ->join('detail_bidang_ilmu', 'detail_bidang_ilmu.bidang_ilmu_id', 'bidang_ilmu.id_bidang_ilmu')
        ->join('users', 'users.id', 'detail_bidang_ilmu.users_id')
        ->join('mata_kuliah_pendukung', 'mata_kuliah_pendukung.id_mata_kuliah_pendukung', 'bidang_ilmu.mata_kuliah_pendukung')
        // ->select('bidang_ilmu.topik_bidang_ilmu', 'users.name', '')
        ->get();

        return view('kajur.bidang_ilmu.index', compact('databi'));
    }
}
