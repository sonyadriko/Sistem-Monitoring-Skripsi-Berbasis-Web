<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KajurDataMahasiswaController extends Controller
{
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $datamhs = DB::table('users')
            ->leftjoin('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
            ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
            ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
            ->where('role_id', 1)->get();

        return view('kajur.mahasiswa.index', compact('datamhs'));
    }
}
