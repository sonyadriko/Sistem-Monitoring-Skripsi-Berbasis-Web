<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan as Pengajuan;

class PengajuanJudulController extends Controller
{
    //

   

    public function create()
    {
        $bidang_ilmu = DB::table('bidang_ilmu')
        ->join('users', 'bidang_ilmu.user_id', '=', 'users.id')
        ->select('bidang_ilmu.id_bidang_ilmu', 'bidang_ilmu.topik_bidang_ilmu', 'bidang_ilmu.status', 'bidang_ilmu.user_id', 'users.name')
        ->where('bidang_ilmu.status', 'tersedia')
        ->get();
        // $bidang_ilmu = DB::table('bidang_ilmu')->select('id_bidang_ilmu', 'topik_bidang_ilmu', 'status', 'user_id')->where('status', 'tersedia')->get();
        return view('mahasiswa/proposal/pengajuan_judul.index', compact('bidang_ilmu'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'npm' => 'required|string',
            'bidang_ilmu' => 'required|string',
            // 'mk_pilihan' => 'required|array',
            // 'judul' => 'required|string',
        ], [
            'nama.required' => 'Nama is required.',
            'npm.required' => 'NPM is required.',
            'bidang_ilmu.required' => 'Bidang Ilmu is required.',
            // 'mk_pilihan.required' => 'At least one course must be selected.',
            // 'mk_pilihan.array' => 'Invalid courses selected.',
            // 'judul.required' => 'Judul is required.',
        ]);    

        $values = explode(',', $validatedData['bidang_ilmu']);
        $bidang_ilmu = trim($values[0]);
        $dosen = trim($values[1]);
        
        $data = DB::table('bidang_ilmu')->where('id_bidang_ilmu', '=', $bidang_ilmu);
        $data->update(['status' => 'tidak']);

        
        $pengajuan = new Pengajuan();
        $pengajuan->nama = $validatedData['nama'];
        $pengajuan->npm = $validatedData['npm'];
        $pengajuan->dosen = $dosen;
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->bidang_ilmu_id = $bidang_ilmu;
     
        $pengajuan->status='pending';
        $pengajuan->save();

        return redirect('/dashboard');
    }

    
}
