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
        // $this->middleware('auth');
        $this->middleware('checkMahasiswa');
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
        $tablesPart1 = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "berita_acara_proposal", "surat_tugas"];
        $tablesPart2 = ["bimbingan_skripsi", "sidang_skripsi", "berita_acara_skripsi"];
        $tables_text = ["pengajuan_judul", "bimbingan_proposal", "sidang_proposal", "revisi_proposal", "surat_tugas", "bimbingan_skripsi", "sidang_skripsi", "revisi_skripsi", "selesai"];
        $tables_text2 = [
            "pengajuan_judul" => "pengajuan_judul",
            "bimbingan_proposal" => "bimbingan_proposal",
            "seminar_proposal" => "seminar_proposal",
            "berita_acara_proposal" => "berita_acara_proposal",
            "surat_tugas" => "surat_tugas",
            "bimbingan_skripsi" => "bimbingan_skripsi",
            "sidang_skripsi" => "sidang_skripsi",
            "berita_acara_skripsi" => "berita_acara_skripsi",
        ];
        $totalTablesPart1 = count($tablesPart1);
        $completedTablesPart1 = 0;
        foreach ($tablesPart1 as $table) {
            $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();
            if ($count > 0) {
                $completedTablesPart1++;
            }
        }
        $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;
        $totalTablesPart2 = count($tablesPart2);
        $completedTablesPart2 = 0;
        foreach ($tablesPart2 as $table) {
            $count = \DB::table($table)->where('users_id', Auth::user()->id)->count();
            if ($count > 0) {
                $completedTablesPart2++;
            }
        }

        $tahap = '';

        $beritaAcaraSkripsiData = \DB::table('berita_acara_skripsi')
            ->where('users_id', Auth::user()->id)
            ->get();


        $countRevisiSidang = \DB::table('berita_acara_skripsi')
            ->whereNotNull('acc_dospem')
            ->whereNotNull('acc_penguji_1')
            ->whereNotNull('acc_penguji_2')
            ->whereNotNull('acc_penguji_3')
            ->where('users_id', Auth::user()->id)
            ->count();

        // dd($countRevisiSidang);

        if ($countRevisiSidang > 0) {
            // Blok ini seharusnya dijalankan jika $countRevisiSidang lebih dari 0
            $progressRevisiSidang = 1; // Atur nilai progress tambahan
            $tahap = 'selesai';
        } else {
            // Blok ini seharusnya dijalankan jika $countRevisiSidang kurang dari atau sama dengan 0
            $progressRevisiSidang = 0;
        }

        // Cek nilai $progressRevisiSidang dan $tahap
        // dd($progressRevisiSidang, $tahap);
        $totalcompleted2 = $completedTablesPart2 + 1;

        $totaltabelhasil = $totalTablesPart2 + $progressRevisiSidang;
        // dd($totaltabelhasil, $totalTablesPart2, $progressRevisiSidang);

        $progressPercentagePart2 = ($totaltabelhasil / $totalcompleted2) * 50; // 100 - 40 = 60
        // dd($progressPercentagePart2, $totalcompleted2, $totaltabelhasil);

        // $finalProgressPercentage = $progressPercentagePart1 + $progressPercentagePart2 + $progressRevisiSidang;
        $finalProgressPercentage = $progressPercentagePart1 + $progressPercentagePart2;
        $hasilprogress = number_format($finalProgressPercentage, 2);

        return view('home', ['progressPercentage' => $hasilprogress, 'tables' => $tables_text, 'tables2' => $tables_text2]);
    }



}
