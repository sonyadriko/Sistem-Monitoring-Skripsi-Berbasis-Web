<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan as Pengajuan;
use App\Models\BimbinganProposal as BimbinganProposal;

use Illuminate\Support\Facades\DB;



class KoordinatorJudulController extends Controller
{
    //
    public function index()
    {
        $juduls = DB::table('tema')
        ->join('users', 'users.id', 'tema.user_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')
        ->orderBy('tema.created_at', 'desc')->get();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('tema')
                ->join('users', 'users.id', 'tema.user_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')
                ->join('users as dosen', 'dosen.id', 'bidang_ilmu.user_id')
                // ->join('bimbingan_proposal', 'bimbingan_proposal.tema_id', 'tema.id_tema')
                ->select('users.name', 'users.kode_unik', 'tema.*', 'bidang_ilmu.topik_bidang_ilmu', 'dosen.name as nama_dosen')
                ->where('id_tema', '=',$id)->first(), 
        ];
        $dosen2 = [
            'dosen2' => DB::table('users')->where('role_id', '2')->get(),
        ];
        return view('koordinator/pengajuan_judul.detail', $data, $dosen2);

    }

    public function updatestatus2(Request $request, $id_tema)
    {
        // Validasi input
        $request->validate([
            'action' => 'required|string|in:terima,tolak',
            'user_id' => 'required|integer',
            'tema_id' => 'required|integer',
            'bidang_ilmu_id' => 'required|integer',
            'dosen_pembimbing_utama' => 'required|string',
            'dosen_pembimbing_ii' => 'required|string',
        ]);
    
        $action = $request->input('action');
        $pengajuan = Pengajuan::findOrFail($id_tema);
    
        // Perbarui status pengajuan
        $pengajuan->status = ($action === 'terima') ? 'terima' : 'tolak';
        $pengajuan->save();
    
        // Simpan data BimbinganProposal
        $bp = new BimbinganProposal();
        $bp->fill($request->only([
            'user_id',
            'tema_id',
            'bidang_ilmu_id',
            'dosen_pembimbing_utama',
            'dosen_pembimbing_ii',
        ]));
        $bp->save();
    
        return redirect()->route('pengajuan-judul.index')->with('success', 'Status pengajuan diperbarui dan BimbinganProposal dibuat.');
    }
    // public function updatestatus2(Request $request, $id_tema)
    // {
       
    //     $action = $request->input('action');
    //     $data = Pengajuan::find($id_tema);

    //     if ($action === 'terima') {
    //         $data->status = 'terima';

    //     } elseif ($action === 'tolak') {
    //         $data->status = 'tolak';
    //     }
    //     $data->save();

    //     $bp = new BimbinganProposal();
    //     $bp->user_id = $request['user_id'];
    //     $bp->tema_id = $request['tema_id'];
    //     $bp->bidang_ilmu_id = $request['bidang_ilmu_id'];
    //     $bp->dosen_pembimbing_utama = $request['dosen_pembimbing_utama'];
    //     $bp->dosen_pembimbing_ii = $request['dosen_pembimbing_ii'];
    //     $bp->save();

    //     return redirect()->route('pengajuan-judul.index');
    // }
    
}
