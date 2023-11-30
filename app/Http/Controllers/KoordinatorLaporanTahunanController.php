<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoordinatorLaporanTahunanController extends Controller
{
    //
    public function index()
    {
        $semproCount = DB::table('seminar_proposal')->count();
        $semhasCount = DB::table('sidang_skripsi')->count();
        $userCount = DB::table('users')->where('role_id', '1')->count();
        $bapCount = DB::table('berita_acara_proposal')->count();
        $basCount = DB::table('berita_acara_skripsi')->count();
        $totalBA = $bapCount + $basCount;

        return view('koordinator/laporan_tahunan.index', compact('semproCount', 'semhasCount', 'userCount', 'totalBA'));
    }
}
