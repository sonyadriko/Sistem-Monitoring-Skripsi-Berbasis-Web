<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanJudul as PengajuanJudul;
use App\Models\BidangIlmu as BidangIlmu;
use Illuminate\Support\Facades\Log;


class PengajuanJudulController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }

    public function create()
    {

        $judul = DB::table('pengajuan_judul')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
                ->select('pengajuan_judul.*', 'bidang_ilmu.topik_bidang_ilmu')
                ->where('pengajuan_judul.users_id', Auth::user()->id)
                ->first();

        $bidang_ilmu = DB::table('bidang_ilmu')
        ->join('users', 'bidang_ilmu.users_id', '=', 'users.id')
        ->select('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.status', 'bidang_ilmu.users_id', 'users.name')
        ->where('bidang_ilmu.status', 'tersedia')
        ->get();

        $cek2 = DB::table('bimbingan_proposal')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->where('bimbingan_proposal.users_id', Auth::user()->id)
            ->first();
        return view('mahasiswa/proposal/pengajuan_judul.index', compact('bidang_ilmu', 'judul', 'cek2'));
    }

    public function showFormPengajuan() {
        // Logika lain yang mungkin dibutuhkan

        // Cek status pengajuan
        $pengajuan = PengajuanJudul::where('users_id', auth()->user()->id)->first();

        if (!$pengajuan) {
            // Jika belum pernah submit pengajuan, tampilkan formulir kosong
            $bidang_ilmu = DB::table('bidang_ilmu')
            ->join('users', 'bidang_ilmu.users_id', '=', 'users.id')
            ->select('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.status', 'bidang_ilmu.users_id', 'users.name')
            ->where('bidang_ilmu.status', 'tersedia')
            ->get();
            return view('mahasiswa/proposal/pengajuan_judul.index2', compact('bidang_ilmu'));
        }

        // Jika status pengajuan 'tolak', kirim alasan penolakan ke formulir
        if ($pengajuan->status == 'tolak') {
            $bidang_ilmu = DB::table('bidang_ilmu')
            ->join('users', 'bidang_ilmu.users_id', '=', 'users.id')
            ->select('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.status', 'bidang_ilmu.users_id', 'users.name')
            ->where('bidang_ilmu.status', 'tersedia')
            ->get();
            return view('mahasiswa/proposal/pengajuan_judul.index', ['alasanPenolakan' => $pengajuan->alasan, 'status' => 'tolak', 'bidang_ilmu' => $bidang_ilmu]);
        }

        // Jika status pengajuan 'pending' atau 'terima', arahkan ke show_status
        if ($pengajuan->status == 'pending' || $pengajuan->status == 'terima') {
            $datas = DB::table('bimbingan_proposal')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->join('users', 'users.id', 'bimbingan_proposal.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->where('bimbingan_proposal.users_id', Auth::user()->id)
            ->first();
            return view('mahasiswa/proposal/pengajuan_judul.show_status', ['id' => $pengajuan->id, 'status' => $pengajuan->status, 'datas' => $datas]);
        }
        // Jika tidak ada kondisi khusus, tampilkan formulir pengajuan tanpa alasan penolakan
        return view('mahasiswa/proposal/pengajuan_judul.index');
    }

    public function store(Request $request) {
        // Validasi input form
        try {
            $request->validate([
                // Sesuaikan dengan aturan validasi Anda
                'judul' => 'required|max:255',
                'bidang_ilmu_id' => 'required',
                'mata_kuliah' => 'required|array',
                'mata_kuliah.*' => 'required|string',
            ]);

            // Cek apakah mahasiswa sudah pernah mengajukan
            $pengajuanExist = PengajuanJudul::where('users_id', auth()->user()->id)->first();

            if ($pengajuanExist) {
                // Jika sudah pernah mengajukan, update data pengajuan yang ada
                $pengajuanExist->update([
                    'users_id' => Auth::user()->id,
                    'bidang_ilmu_id' => $request->bidang_ilmu_id,
                    'judul' => $request->judul,
                    'mk_pilihan' => implode(', ', $request->mata_kuliah),
                    'status' => 'pending', // Atur status ke 'pending' karena pengajuan baru
                    'alasan' => null, // Reset alasan penolakan jika ada
                ]);
                $pengajuanExist->increment('jumlah_pengajuan');

                return redirect()->route('mahasiswa/proposal/pengajuan_judul.show_status', ['id' => $pengajuanExist->id, 'status' => 'pending']);
            } else {
                // Jika belum pernah mengajukan, buat data pengajuan baru
                PengajuanJudul::create([
                    'users_id' => auth()->user()->id,
                    'judul' => $request->judul,
                    'bidang_ilmu_id' => $request->bidang_ilmu_id,
                    'mk_pilihan' => implode(', ', $request->mata_kuliah),
                    'status' => 'pending', // Set status ke 'pending'
                    'jumlah_pengajuan' => 1, // Set jumlah_pengajuan menjadi 1
                ]);

                return redirect()->route('mahasiswa/proposal/pengajuan_judul.show_status', ['id' => auth()->user()->id, 'status' => 'pending']);
            }
        } catch (\Exception $e) {
            // Tampilkan pesan kesalahan atau log ke file log
            Log::error('Error while processing form submission: ' . $e->getMessage());
            // Tampilkan pesan kesalahan kepada pengguna
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }


}