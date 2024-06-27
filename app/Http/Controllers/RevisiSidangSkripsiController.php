<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RevisiSidangSkripsi as RevisiSidangSkripsi;
use App\Models\DetailRevisiSidangSkripsi as DetailRevisiSidangSkripsi;

class RevisiSidangSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {
        $userId = Auth::user()->id;

       $revisisk = DB::table('detail_berita_acara_skripsi')
            ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.*', 'berita_acara_skripsi.users_id', 'users.*', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi')
            ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
            ->join('users', 'users.id', 'detail_berita_acara_skripsi.users_id')
            ->join('revisi_sidang_skripsi', 'revisi_sidang_skripsi.berita_acara_skripsi_id', 'berita_acara_skripsi.id_berita_acara_s')
            ->where('berita_acara_skripsi.users_id', $userId)
            ->first();

        $revisisk2 = DB::table('detail_berita_acara_skripsi')
            ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.id_berita_acara_s', 'users.*')
            ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
            ->join('users', 'users.id', 'detail_berita_acara_skripsi.users_id')
            ->where('berita_acara_skripsi.users_id', $userId)
            ->get();

            $detailrev = DB::table('detail_revisi_sidang_skripsi')
            ->select('detail_revisi_sidang_skripsi.*', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi', 'users.*')
            ->join('revisi_sidang_skripsi', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi', 'detail_revisi_sidang_skripsi.revisi_sidang_skripsi_id')
            ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
            ->join('users', 'users.id', 'detail_revisi_sidang_skripsi.users_id')
            ->where('berita_acara_skripsi.users_id', $userId)
            ->get();


        return view('mahasiswa/skripsi/revisi.index', compact('revisisk', 'revisisk2', 'detailrev')) ;

    }
}