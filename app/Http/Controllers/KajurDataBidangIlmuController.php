<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataBidangIlmuController extends Controller
{
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $databi = DB::table('bidang_ilmu')
        ->join('users', 'users.id', 'bidang_ilmu.users_id')
        ->get();

        return view('kajur.bidang_ilmu.index', compact('databi'));
    }
}
