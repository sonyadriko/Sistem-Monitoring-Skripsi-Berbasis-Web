<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurController extends Controller
{

    public function index()
    {
        $mahasiswaCount = DB::table('users')->where('role_id', '1')->count();
        $dosenCount = DB::table('users')->where('role_id', '2')->count();
        $pengajuanCount = DB::table('seminar_proposal')->count();
        $pengajuanCount2 = DB::table('sidang_skripsi')->count();
        $total = $pengajuanCount + $pengajuanCount2;
        $bidangIlmuCount = DB::table('bidang_ilmu')->count();


        return view('kajur.index', compact('mahasiswaCount', 'dosenCount', 'total', 'bidangIlmuCount'));
    }
}
