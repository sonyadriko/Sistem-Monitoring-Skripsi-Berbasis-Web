<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryBimbinganController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {
        $userId = Auth::user()->id; // Menyimpan user ID ke dalam variabel untuk memudahkan penggunaan

        $hisbimmhs = DB::table('detail_bimbingan_proposal')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', '=', 'detail_bimbingan_proposal.bimbingan_proposal_id')
            ->join('users', 'users.id', '=', 'bimbingan_proposal.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', '=', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', '=', 'bimbingan_proposal.pengajuan_id')
            ->select('detail_bimbingan_proposal.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'bimbingan_proposal.dosen_pembimbing_utama',  'bimbingan_proposal.dosen_pembimbing_ii', 'pengajuan_judul.judul')
            ->where('users.id', $userId)
            ->get();

            $hisbimdet = DB::table('bimbingan_proposal')
            ->join('users', 'users.id', '=', 'bimbingan_proposal.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', '=', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', '=', 'bimbingan_proposal.pengajuan_id')
            ->select('bimbingan_proposal.*', 'users.kode_unik', 'users.name', 'bidang_ilmu.topik_bidang_ilmu', 'pengajuan_judul.judul')
            ->where('users.id', $userId)
            ->get();



        return view('mahasiswa/proposal/history_bimbingan.index', compact('hisbimmhs', 'hisbimdet'));
    }

    public function store(Request $request)
    {

    }
}