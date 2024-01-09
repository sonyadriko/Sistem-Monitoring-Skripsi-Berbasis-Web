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

    // public function index()
    // {
    //     $tables = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "berita_acara_proposal", "surat_tugas", "bimbingan_skripsi", "sidang_skripsi", "berita_acara_skripsi", "yudisium" /* ... */];
    //     $tables_text = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "revisi_proposal", "surat_tugas", "bimbingan_skripsi", "sidang_skripsi", "revisi_skripsi", "yudisium" /* ... */];
    //     $totalTables = count($tables);
    //     $completedTables = 0;

    //     foreach ($tables as $table) {
    //         $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();

    //         if ($count > 0) {
    //             $completedTables++;
    //         }
    //     }

    //     $progressPercentage = ($completedTables / $totalTables) * 100;
    //     $hasilprogress = number_format($progressPercentage, 2);

    //     return view('home', ['progressPercentage' => $hasilprogress, 'tables' => $tables_text]);
    // }
    public function index()
    {
        $tablesPart1 = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "berita_acara_proposal", "surat_tugas"];
        $tablesPart2 = ["bimbingan_skripsi", "sidang_skripsi", "berita_acara_skripsi", "yudisium"];

        $tables_text = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "revisi_proposal", "surat_tugas", "bimbingan_skripsi", "sidang_skripsi", "revisi_skripsi", "yudisium"];

        // Menghitung persentase untuk bagian pertama (pengajuan judul sampai surat tugas)
        $totalTablesPart1 = count($tablesPart1);
        $completedTablesPart1 = 0;

        foreach ($tablesPart1 as $table) {
            $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();

            if ($count > 0) {
                $completedTablesPart1++;
            }
        }

        $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;

        // Menghitung persentase untuk bagian kedua (bimbingan skripsi sampai yudisium)
        $totalTablesPart2 = count($tablesPart2);
        $completedTablesPart2 = 0;

        foreach ($tablesPart2 as $table) {
            $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();

            if ($count > 0) {
                $completedTablesPart2++;
            }
        }

        $progressPercentagePart2 = ($completedTablesPart2 / $totalTablesPart2) * 50; // 100 - 40 = 60

        $finalProgressPercentage = $progressPercentagePart1 + $progressPercentagePart2;
        // dd([$completedTablesPart1, $totalTablesPart1, $completedTablesPart2, $totalTablesPart2, $finalProgressPercentage]);
        $hasilprogress = number_format($finalProgressPercentage, 2);

        return view('home', ['progressPercentage' => $hasilprogress, 'tables' => $tables_text]);
    }



}
