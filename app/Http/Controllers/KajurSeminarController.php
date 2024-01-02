<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KajurSeminarController extends Controller
{
    public function index()
    {
        $sempros = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            ->leftjoin('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            ->select('seminar_proposal.*', 'users.kode_unik', 'users.name', 'ruangan.nama_ruangan', 'penguji1.name as nama_penguji_1')
            ->whereIn('seminar_proposal.status', ['pending', 'terima'])
            ->latest('seminar_proposal.created_at')
            ->get();

        return view('kajur/jadwal/seminar.index', compact('sempros'));
    }

    public function detail($id)
    {
        $data = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->where('pengajuan_judul.status', 'terima')
            ->where('id_seminar_proposal', $id)
            ->first();

            $data2 = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            ->select(
                'seminar_proposal.*',
                'bimbingan_proposal.dosen_pembimbing_utama',
                'bimbingan_proposal.dosen_pembimbing_ii',
                'ruangan.nama_ruangan', 'users.*',
                'bidang_ilmu.topik_bidang_ilmu',
                'penguji1.name as nama_penguji_1',
                'penguji2.name as nama_penguji_2'
                )
            ->where('id_seminar_proposal', $id)
            ->first();

        // Debugging statements
        // dd($data); // Check the retrieved data

        // if (!$data) {
        //     // Log a message or use dd() to debug
        //     dd("Record not found for ID: $id");
        // }

        $baru = DB::table('users')->where('role_id', '2')->get();
        $listRuangan = DB::table('ruangan')->get();

        return view('kajur/jadwal/seminar.detail', compact('data', 'data2', 'baru', 'listRuangan'));
    }
}
