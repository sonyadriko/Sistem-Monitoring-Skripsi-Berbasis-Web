<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KajurSidangController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKajur');
    }
    public function index()
    {
        $semhas = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            ->leftjoin('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            ->select('sidang_skripsi.*', 'users.kode_unik', 'users.name', 'ruangan.nama_ruangan', 'penguji1.name as nama_penguji_1')
            ->whereIn('sidang_skripsi.status', ['pending', 'terima'])
            ->latest('sidang_skripsi.created_at')
            ->get();
        return view('kajur/jadwal/sidang.index', compact('semhas'));
    }
    public function detail($id)
    {
        $data = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            // ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            // ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
            // ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
            // ->join('users as sekre', 'sekre.id', 'sidang_skripsi.sekretaris')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            // ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            // ->select('sidang_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii', 'ruangan.nama_ruangan', 'users.*', 'bimbingan_skripsi.*', 'bidang_ilmu.topik_bidang_ilmu', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3', 'sekre.name as nama_sekretaris')
            ->where('id_sidang_skripsi',  $id)
            ->where('pengajuan_judul.status', 'terima')
            ->first();
        $data2 = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
            ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            ->select('sidang_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii', 'ruangan.nama_ruangan', 'users.*', 'bimbingan_skripsi.*', 'bidang_ilmu.topik_bidang_ilmu', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3')
            ->where('id_sidang_skripsi', $id)
            ->first();


        $baru = DB::table('users')->where('role_id', '2')->get();
        $listRuangan = DB::table('ruangan')->get();

        return view('kajur/jadwal/sidang.detail', compact('data', 'baru', 'listRuangan', 'data2'));
    }
}
