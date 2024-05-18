<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

/**
 * Controller untuk mengelola bimbingan proposal mahasiswa.
 */
class BimbinganProposalController extends Controller
{
    /**
     * Constructor untuk BimbinganProposalController.
     * Middleware 'checkMahasiswa' digunakan untuk memastikan hanya mahasiswa yang dapat mengakses.
     */
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }

    /**
     * Menampilkan halaman utama bimbingan proposal.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil data dosen pembimbing berdasarkan ID pengguna
        $dosens = DB::table('bimbingan_proposal')
                    ->where('users_id', $userId)
                    ->first();

        // Mengambil detail bimbingan proposal terbaru berdasarkan ID pengguna
        $detailbim = DB::table('detail_bimbingan_proposal')
                       ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', '=', 'detail_bimbingan_proposal.bimbingan_proposal_id')
                       ->where('bimbingan_proposal.users_id', $userId)
                       ->latest('detail_bimbingan_proposal.created_at')
                       ->first();

        // Mengembalikan view dengan data dosen pembimbing dan detailnya
        return view('mahasiswa/proposal/bimbingan.index', compact('dosens', 'detailbim'));
    }
}

