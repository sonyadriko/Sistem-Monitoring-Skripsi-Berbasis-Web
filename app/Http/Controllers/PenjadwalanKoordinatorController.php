<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjadwalanKoordinatorController extends Controller
{
    public function index()
    {
        $semproCount = DB::table('seminar_proposal')->whereIn('status', ['pending', 'terima'])->count();
        $semhasCount = DB::table('sidang_skripsi')->count();
        $jadwalCount = $semproCount+$semhasCount;

        return view('koordinator/penjadwalan.index', compact('semproCount', 'semhasCount', 'jadwalCount'));
    }
}
