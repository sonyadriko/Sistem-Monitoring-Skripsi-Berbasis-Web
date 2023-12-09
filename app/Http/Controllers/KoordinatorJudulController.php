<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\PengajuanJudul as PengajuanJudul;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\PengajuanJudul as PengajuanJudul;

use Illuminate\Support\Facades\DB;



class KoordinatorJudulController extends Controller
{
    //
    public function index()
    {
        $juduls = DB::table('pengajuan_judul')
        ->join('users', 'users.id', 'pengajuan_judul.user_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
        ->orderBy('pengajuan_judul.created_at', 'desc')->get();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('pengajuan_judul')
                ->join('users', 'users.id', 'pengajuan_judul.user_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
                ->join('users as dosen', 'dosen.id', 'bidang_ilmu.user_id')
                ->select('users.name', 'users.kode_unik', 'pengajuan_judul.*', 'bidang_ilmu.topik_bidang_ilmu', 'dosen.name as nama_dosen')
                ->where('id_pengajuan_judul',$id)->first(),
        ];
        $dosen2 = [
            'dosen2' => DB::table('pengajuan_judul')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
                ->join('detail_bidang_ilmu', 'detail_bidang_ilmu.bidang_ilmu_id', 'bidang_ilmu.id_bidang_ilmu')
                ->join('users', 'users.id', 'detail_bidang_ilmu.users_id')
                ->where('role_id', '2')
                ->get(),
        ];

        return view('koordinator/pengajuan_judul.detail', $data, $dosen2);

    }

    public function updatestatus2(Request $request, $id_tema)
    {
        $request->validate([
            'action' => 'required|string|in:terima,tolak',
            'user_id' => 'required|integer',
            'pengajuan_id' => 'required|integer',
            'bidang_ilmu_id' => 'required|integer',
            'dosen_pembimbing_utama' => 'required|string',
            'dosen_pembimbing_ii' => 'required|string',
        ]);

        $action = $request->input('action');
        $pengajuan = PengajuanJudul::findOrFail($id_tema);

        // Perbarui status pengajuan
        $pengajuan->status = $action;
        $pengajuan->save();

        // Conditionally create BimbinganProposal only when the action is 'terima'
        if ($action === 'terima') {
            $bp = new BimbinganProposal();
            $bp->fill($request->only([
                'user_id',
                'pengajuan_id',
                'bidang_ilmu_id',
                'dosen_pembimbing_utama',
                'dosen_pembimbing_ii',
            ]));
            $bp->save();
        }

        return redirect()->route('pengajuan-judul.index')->with('success', 'Status pengajuan diperbarui' . ($action === 'terima' ? ' dan Bimbingan Proposal dibuat.' : '.'));
    }

}
