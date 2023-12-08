<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan as Pengajuan;
use App\Models\BidangIlmu as BidangIlmu;


class PengajuanJudulController extends Controller
{
    //



    public function create()
    {

        $temacek = DB::table('tema')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')
                ->select('tema.*', 'bidang_ilmu.topik_bidang_ilmu')
                ->where('tema.user_id', Auth::user()->id)
                ->first();

        $bidang_ilmu = DB::table('bidang_ilmu')
        ->join('users', 'bidang_ilmu.user_id', '=', 'users.id')
        ->select('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.status', 'bidang_ilmu.user_id', 'users.name')
        ->where('bidang_ilmu.status', 'tersedia')
        ->get();
        // $bidang_ilmu = DB::table('bidang_ilmu')->select('id_bidang_ilmu', 'topik_bidang_ilmu', 'status', 'user_id')->where('status', 'tersedia')->get();
        return view('mahasiswa/proposal/pengajuan_judul.index', compact('bidang_ilmu', 'temacek'));
    }

    public function store(Request $request)
    {
        // Validasi data formulir
        $validatedData = $request->validate([
            'bidang_ilmu' => 'required|exists:bidang_ilmu,id_bidang_ilmu',
            'judul' => 'required|string',  // Sesuaikan dengan atribut formulir Anda
            // 'mata_kuliah' => 'required|array',  // Sesuaikan dengan atribut formulir Anda
            'mata_kuliah' => 'required|array|min:1',  // Minimal satu checkbox dipilih
            'mata_kuliah.*' => 'string',  // Sesuaikan dengan atribut formulir Anda
            // Tambahkan validasi untuk data formulir lainnya jika ada
        ], [
            'bidang_ilmu.required' => 'Bidang Ilmu is required.',
            'bidang_ilmu.exists' => 'Invalid Bidang Ilmu selected.',
            'judul.required' => 'Judul is required.',
            'mata_kuliah.required' => 'Pilih setidaknya satu mata kuliah.',
            'mata_kuliah.min' => 'Pilih setidaknya satu mata kuliah.',
            // Tambahkan pesan validasi untuk bidang formulir lainnya jika diperlukan
        ]);

        // Simpan pengajuan
        $pengajuan = new Pengajuan();
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->bidang_ilmu_id = $validatedData['bidang_ilmu'];
        $pengajuan->status = 'pending';
        $pengajuan->judul = $validatedData['judul'];
        $pengajuan->mk_pilihan = implode(', ', $validatedData['mata_kuliah']);
        $pengajuan->save();

        // Tambahan logika untuk menyimpan data formulir lainnya (jika ada)
        // Contoh: Simpan data mahasiswa, judul, dll.

        return redirect('/dashboard')->with('success', 'Pengajuan berhasil dilakukan.');
    }



}
