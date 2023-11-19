<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjadwalanKoordinatorController extends Controller
{
    public function index()
    {
        $semproCount = DB::table('seminar_proposal')->count();
        $semhasCount = DB::table('sidang_skripsi')->count();
        $jadwalCount = $semproCount+$semhasCount;
        // $jadwalCount = DB::table('tema')->where('status', 'pending')->count();

        return view('koordinator/penjadwalan.index', compact('semproCount', 'semhasCount', 'jadwalCount'));
    }
}
