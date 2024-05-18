<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailBimbinganSkripsi as DetailBimbinganSkripsi;

/**
 * Controller untuk mengelola bimbingan skripsi mahasiswa.
 */
class BimbinganSkripsiController extends Controller
{
    /**
     * Constructor untuk BimbinganSkripsiController.
     * Middleware 'checkMahasiswa' digunakan untuk memastikan hanya mahasiswa yang dapat mengakses.
     */
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }

    /**
     * Menampilkan halaman utama bimbingan skripsi.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil data bimbingan skripsi berdasarkan ID pengguna
        $bimbingans = DB::table('bimbingan_skripsi')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', '=', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->select('bimbingan_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii')
            ->where('bimbingan_skripsi.users_id', $userId)
            ->first();

        // Mengambil detail bimbingan skripsi terbaru berdasarkan ID pengguna
        $detailbim = DB::table('detail_bimbingan_skripsi')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', '=', 'detail_bimbingan_skripsi.bimbingan_skripsi_id')
            ->leftJoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', '=', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->where('bimbingan_skripsi.users_id', $userId)
            ->orderByDesc('detail_bimbingan_skripsi.created_at')
            ->first();

        // Mengembalikan view dengan data bimbingan skripsi dan detailnya
        return view('mahasiswa/skripsi/bimbingan.index', compact('bimbingans', 'detailbim'));
    }
}
