<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KajurDataMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKajur');
    }
    public function index()
    {
        // Mengambil data mahasiswa dan informasi kemajuan
        $datamhs = DB::table('users')
            ->leftjoin('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
            ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
            ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
            ->where('role_id', 1)
            ->where('users.status', 'aktif')
            ->get();

        $angkatan = DB::table('angkatan')->get();

        $user = Auth::user();

        $tablesPart1 = ["pengajuan_judul", "bimbingan_proposal", "seminar_proposal", "berita_acara_proposal", "surat_tugas"];
        $tablesPart2 = ["bimbingan_skripsi", "sidang_skripsi", "berita_acara_skripsi"];

    // Menghitung kemajuan untuk bagian pertama
    $totalTablesPart1 = count($tablesPart1);
    $completedTablesPart1 = 0;

    foreach ($tablesPart1 as $table) {
        $count = DB::table($table)->where('users_id', Auth::user()->id)->count();

        if ($count > 0) {
            $completedTablesPart1++;
        }
    }

    $progressPercentagePart1 = ($completedTablesPart1 / $totalTablesPart1) * 50;

    // Menghitung kemajuan untuk bagian kedua
    $totalTablesPart2 = count($tablesPart2);
    $completedTablesPart2 = 0;

    foreach ($tablesPart2 as $table) {
        $count = DB::table($table)->where('users_id', Auth::user()->id)->count();

        if ($count > 0) {
            $completedTablesPart2++;
        }
    }

    $progressPercentagePart2 = ($completedTablesPart2 / $totalTablesPart2) * 50; // 100 - 40 = 60

    // Menggabungkan kemajuan dari kedua bagian
    $finalProgressPercentage = $progressPercentagePart1 + $progressPercentagePart2;

    // Format persentase menjadi dua desimal
    $hasilprogress = number_format($finalProgressPercentage, 2);

        // Mengirimkan data ke view
        return view('kajur.mahasiswa.index', compact('datamhs', 'hasilprogress', 'tablesPart1', 'tablesPart2', 'angkatan'));
    }


    public function detail($id)
    {
        $datamhs = DB::table('users')
        ->leftjoin('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->where('users.id', $id)
        ->first();

        return view('kajur.mahasiswa.detail', compact('datamhs'));
    }
}
