<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataMahasiswaController extends Controller
{
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $datamhs = DB::table('users')->where('role_id', 1)->get();

        return view('kajur.mahasiswa.index', compact('datamhs'));
    }
}
