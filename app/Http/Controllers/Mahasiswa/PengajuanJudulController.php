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
        $validatedData = $request->validate([
            'bidang_ilmu' => 'required|string',
        ], [
            'bidang_ilmu.required' => 'Bidang Ilmu is required.',
        ]);

        // Perbarui status bidang ilmu
        $bidangIlmu = BidangIlmu::findOrFail($validatedData['bidang_ilmu']);
        $bidangIlmu->status = 'tidak';
        $bidangIlmu->save();

        // Simpan pengajuan
        $pengajuan = new Pengajuan();
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->bidang_ilmu_id = $validatedData['bidang_ilmu'];
        $pengajuan->status = 'pending';
        $pengajuan->save();

        return redirect('/dashboard')->with('success', 'Pengajuan berhasil dilakukan.');
    }



}
