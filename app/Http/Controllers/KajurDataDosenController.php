<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataDosenController extends Controller
{
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $datadsn = DB::table('users')->where('role_id', 2)->get();

        return view('kajur.dosen.index', compact('datadsn'));
    }
}
