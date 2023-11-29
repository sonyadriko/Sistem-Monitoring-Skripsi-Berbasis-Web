<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataPenggunaController extends Controller
{
    public function index()
    {
        $datas = DB::table('users')->where('role_id', '1')->get();
        return view('koordinator/data_pengguna.index', compact('datas'));
    }
}
