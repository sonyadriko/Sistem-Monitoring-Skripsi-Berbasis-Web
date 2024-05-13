<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {
        $currentUser = Auth::user();
        $mahasiswaCount = DB::table('bimbingan_proposal')
        ->where(function ($query) use ($currentUser) {
            $query->where('dosen_pembimbing_utama', $currentUser->name)
                  ->orWhere('dosen_pembimbing_ii', $currentUser->name);
        })
        ->count();
        $BICount = DB::table('detail_bidang_ilmu')->where('users_id', $currentUser->id)->count();
        $s1 = DB::table('seminar_proposal')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->where('seminar_proposal.status','terima')
            ->where(function($query2) use ($currentUser) {
            $query2->where('dosen_penguji_1', $currentUser->id)
                    ->orWhere('dosen_penguji_2', $currentUser->id)
                    ->orWhere('dosen_pembimbing_utama', $currentUser->name);
        })
        ->count();
        $s2 = DB::table('sidang_skripsi')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->where(function($query2) use ($currentUser) {
                $query2->where('dosen_penguji_1', $currentUser->id)
                        ->orWhere('dosen_penguji_2', $currentUser->id)
                        ->orWhere('dosen_penguji_3', $currentUser->id)
                        ->orWhere('dosen_pembimbing_utama', $currentUser->name);

        })
        ->count();
        $s3 = $s1 + $s2;

        // Define cards data
        $cards = [
            [
                'title' => 'Mahasiswa Bimbingan',
                'count' => $mahasiswaCount,
                'color' => '#007bff',
                'icon' => 'bi:people-fill',
                'route' => 'bimbingan-dosen.index'
            ],
            [
                'title' => 'Bidang Ilmu',
                'count' => $BICount,
                'color' => '#28a745',
                'icon' => 'bi:book-half',
                'route' => 'dosen-bidang-ilmu.index'
            ],
            [
                'title' => 'Jadwal Menguji',
                'count' => $s3,
                'color' => '#ffc107',
                'icon' => 'bi:card-checklist',
                'route' => 'jadwal-menguji.index'
            ]
        ];

        return view('dosen.index', compact('cards'));
    }

}