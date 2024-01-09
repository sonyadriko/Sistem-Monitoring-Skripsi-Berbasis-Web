<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurJadwalController extends Controller
{
    public function index()
    {
        $semproCount = DB::table('seminar_proposal')->whereIn('status', ['pending', 'terima'])->count();
        $semhasCount = DB::table('sidang_skripsi')->count();
        $jadwalCount = $semproCount+$semhasCount;

        return view('kajur/jadwal.index', compact('semproCount', 'semhasCount', 'jadwalCount'));
    }
}
