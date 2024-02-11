<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class KajurDataDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKajur');
    }
    public function index()
    {
        // Use get() to execute the query and get the results as an array of objects
        $datadsn = DB::table('users')
            ->leftjoin('detail_bidang_ilmu', 'detail_bidang_ilmu.users_id', 'users.id')
            ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'detail_bidang_ilmu.bidang_ilmu_id')
            ->where('role_id', 2)
            ->orderBy('name', 'asc') // Sort by
            ->get();

        return view('kajur.dosen.index', compact('datadsn'));
    }

    public function detail($id)
    {
        // $data = DB::table('users')->where('id', $id)->first();
        // $user = DB::table('users')->findOrFail($id);
        $user = User::findOrFail($id);
        // $id =
        $datadsn = DB::table('users')
            ->leftjoin('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
            ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
            ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.pengajuan_id', 'pengajuan_judul.id_pengajuan_judul')
            ->where('dosen_pembimbing_utama', $user->name)->get();
            // dd($datadsn);
            return view('kajur.dosen.detail', compact('datadsn', 'user'));
    }
}
