<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KoordinatorSuratTugasController extends Controller
{
    //
    public function index()
    {
        $surattugas = DB::table('surat_tugas')->join('users', 'users.id', 'surat_tugas.user_id')->get();
     
        return view('koordinator/surat_tugas.index', compact('surattugas'));
    }
}
