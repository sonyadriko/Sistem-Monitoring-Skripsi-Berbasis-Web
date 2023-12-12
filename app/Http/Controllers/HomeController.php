<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function getTableProgress($table)
    {
        $count = DB::table($table)->where('users_id', Auth::user()->id)->count();
        $totalRows = DB::table($table)->count();

        if ($totalRows > 0) {
            return round(($count / $totalRows) * 100, 2);
        }

        return 0;
    }

    public function index()
    {
        $tables = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "berita_acara_proposal", "surat_tugas", "bimbingan_skripsi", "sidang_skripsi", "berita_acara_skripsi" /* ... */];
        $totalTables = count($tables);
        $completedTables = 0;

        foreach ($tables as $table) {
            $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();

            if ($count > 0) {
                $completedTables++;
            }
        }

        $progressPercentage = ($completedTables / $totalTables) * 100;

        return view('home', ['progressPercentage' => $progressPercentage, 'tables' => $tables]);
    }

}
