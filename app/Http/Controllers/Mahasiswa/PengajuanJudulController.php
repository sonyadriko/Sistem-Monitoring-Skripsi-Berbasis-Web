<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Judul as Judul;

class PengajuanJudulController extends Controller
{
    //

   

    public function create()
    {
        // $juduls = Judul::all();
        $bidang_ilmu = DB::table('bidang_ilmu')->select('id_bidang_ilmu', 'topik_bidang_ilmu')->get();
        return view('mahasiswa/proposal/pengajuan_judul.index', compact('bidang_ilmu'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'npm' => 'required|string',
            'bidang_ilmu' => 'required|string',
            'mk_pilihan' => 'required|array',
            'judul' => 'required|string',
        ], [
            'nama.required' => 'Nama is required.',
            'npm.required' => 'NPM is required.',
            'bidang_ilmu.required' => 'Bidang Ilmu is required.',
            'mk_pilihan.required' => 'At least one course must be selected.',
            'mk_pilihan.array' => 'Invalid courses selected.',
            'judul.required' => 'Judul is required.',
        ]);    

        $pengajuan = new Judul();
        $pengajuan->nama = $validatedData['nama'];
        $pengajuan->npm = $validatedData['npm'];
        // $pengajuan->user_id = Auth::user()->id();
        $pengajuan->user_id = Auth::user()->id;
        $pengajuan->bidang_ilmu_id = $validatedData['bidang_ilmu'];
        $mk = implode(', ', $validatedData['mk_pilihan']);
        $pengajuan->mk_pilihan = $mk;
        $pengajuan->judul = $validatedData['judul'];
        // var_dump($pengajuan);
        $pengajuan->status='pending';
        $pengajuan->dosen='belum';
        $pengajuan->save();

        return redirect('/dashboard');
    }

    
}
