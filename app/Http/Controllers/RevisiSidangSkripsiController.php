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

        $revisisk = DB::table('detail_berita_acara_skripsi')
            ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.*', 'berita_acara_skripsi.users_id', 'users.*', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi')
            ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
            ->join('users', 'users.id', '=', 'detail_berita_acara_skripsi.users_id')
            ->join('revisi_sidang_skripsi', 'revisi_sidang_skripsi.berita_acara_skripsi_id', 'berita_acara_skripsi.id_berita_acara_s')
            ->where('berita_acara_skripsi.users_id', Auth::user()->id)
            ->first();
// dd($revisisk);
        $revisisk2 = DB::table('detail_berita_acara_skripsi')
            ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.id_berita_acara_s', 'users.*')
            ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
            ->join('users', 'users.id', '=', 'detail_berita_acara_skripsi.users_id')
            ->where('berita_acara_skripsi.users_id', Auth::user()->id)
            ->get();

        return view('mahasiswa/skripsi/revisi.index', compact('revisisk', 'revisisk2')) ;

    }
}
