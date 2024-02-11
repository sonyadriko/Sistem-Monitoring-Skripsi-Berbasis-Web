<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataBidangIlmuController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKajur');
    }
    public function index()
    {
        $databi = DB::table('bidang_ilmu')
        ->leftJoin('detail_bidang_ilmu', 'detail_bidang_ilmu.bidang_ilmu_id', '=', 'bidang_ilmu.id_bidang_ilmu')
        ->join('users', 'users.id', '=', 'detail_bidang_ilmu.users_id')
        ->select(
            'bidang_ilmu.id_bidang_ilmu',
            'bidang_ilmu.topik_bidang_ilmu',
            'bidang_ilmu.mata_kuliah_pendukung', // Add this line
            DB::raw('GROUP_CONCAT(users.name) AS nama_dosen'),
            DB::raw('(
                SELECT GROUP_CONCAT(DISTINCT nama_mata_kuliah)
                FROM mata_kuliah_pendukung
                WHERE FIND_IN_SET(mata_kuliah_pendukung.id_mata_kuliah_pendukung, bidang_ilmu.mata_kuliah_pendukung) > 0
            ) AS nama_mata_kuliah')
        )
        ->groupBy('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.mata_kuliah_pendukung')
        ->get();

        return view('kajur.bidang_ilmu.index', compact('databi'));
    }
}
