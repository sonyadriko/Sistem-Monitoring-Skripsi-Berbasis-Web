<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataPenggunaController extends Controller
{
    public function index()
    {
        // $datas = DB::table('users')->where('role_id', '1')->get();
        $mahasiswaCount = DB::table('users')->where('role_id', '1')->count();
        $dosenCount = DB::table('users')->where('role_id', '2')->count();
        $kajurCount = DB::table('users')->where('role_id', '4')->count();
        return view('koordinator/data_pengguna.index', compact('mahasiswaCount', 'dosenCount', 'kajurCount'));
    }
    public function mhs()
    {
        $datas = DB::table('users')->where('role_id', '1')->get();
        return view('koordinator/data_pengguna/mahasiswa.index', compact('datas'));
    }
    public function dosen()
    {
        $datas = DB::table('users')->where('role_id', '2')->get();
        return view('koordinator/data_pengguna/dosen.index', compact('datas'));
    }
    public function kajur()
    {
        $datas = DB::table('users')->where('role_id', '4')->get();
        return view('koordinator/data_pengguna/kajur.index', compact('datas'));
    }
}
