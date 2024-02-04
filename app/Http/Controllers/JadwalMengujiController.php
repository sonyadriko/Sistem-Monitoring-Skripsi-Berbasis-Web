<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalMengujiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {

        $jadwalMengujis = DB::table('berita_acara_skripsi')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->leftjoin('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
        ->where(function($query) {
            $query->where('sidang_skripsi.dosen_penguji_1', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_2',  Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_3', Auth::user()->id)
                  ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);

        })
        ->whereDate('sidang_skripsi.tanggal', '>=', now()->toDateString()) // Filter for today and beyond
        ->latest('berita_acara_skripsi.created_at')
        ->get();


        $jadwalMengujip = DB::table('berita_acara_proposal')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
        ->leftjoin('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
        ->where(function($query) {
            $query->where('seminar_proposal.dosen_penguji_1', Auth::user()->id)
                  ->orWhere('seminar_proposal.dosen_penguji_2', Auth::user()->id)
                  ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);
        })
        ->whereDate('seminar_proposal.tanggal', '>=', now()->toDateString()) // Filter for today and beyond
        ->latest('berita_acara_proposal.created_at')
        ->get();

        $jadwalMengujis = $jadwalMengujis->map(function ($item) {
            $item->jenis_sidang = 'Skripsi';
            return $item;
        });

        $jadwalMengujip = $jadwalMengujip->map(function ($item) {
            $item->jenis_sidang = 'Proposal';
            return $item;
        });

        $mergedJadwal = $jadwalMengujis->merge($jadwalMengujip);

        // Filter data unik berdasarkan tanggal, ruangan, dan jam
        $uniqueJadwal = $mergedJadwal->unique(function ($item) {
            return $item->tanggal . $item->nama_ruangan . $item->jam;
        });


        $angkatan = DB::table('angkatan')->get();



        // return view('dosen/jadwal_menguji.index', compact('jadwalMengujis', 'angkatan', 'jadwalMengujip'));
        return view('dosen/jadwal_menguji.index', compact('uniqueJadwal', 'angkatan'));

    }

    public function detailshow($jadwal)
    {
        try {
        $jadwalMengujis = DB::table('berita_acara_skripsi')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->leftjoin('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
        ->where(function($query) {
            $query->where('sidang_skripsi.dosen_penguji_1', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_2',  Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_3', Auth::user()->id)
                  ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);

        })
        ->whereDate('sidang_skripsi.tanggal', '=', $jadwal) // Filter for today and beyond
        ->latest('berita_acara_skripsi.created_at')
        ->get();

        $jadwalMengujip = DB::table('berita_acara_proposal')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
        ->leftjoin('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
        ->where(function($query) {
            $query->where('seminar_proposal.dosen_penguji_1', Auth::user()->id)
                  ->orWhere('seminar_proposal.dosen_penguji_2', Auth::user()->id)
                  ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);
        })
        ->whereDate('seminar_proposal.tanggal', '=', $jadwal)
        ->latest('berita_acara_proposal.created_at')
        ->get();

        $angkatan = DB::table('angkatan')->get();

        return view('dosen/jadwal_menguji.detail_index', compact('jadwalMengujis', 'angkatan', 'jadwalMengujip'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->view('errors.500', [], 500);
        }

    }
}
