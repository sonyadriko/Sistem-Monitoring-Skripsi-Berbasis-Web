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
        ->join('users', 'users.id', 'pengajuan_judul.users_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
        ->orderBy('pengajuan_judul.created_at', 'desc')->get();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }
    public function detail($id)
    {
        $data = DB::table('pengajuan_judul')
            ->join('users', 'users.id', 'pengajuan_judul.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
            ->join('users as dosen', 'dosen.id', 'bidang_ilmu.users_id')
            ->select('users.name', 'users.kode_unik', 'pengajuan_judul.*', 'bidang_ilmu.topik_bidang_ilmu', 'dosen.name as nama_dosen')
            ->where('id_pengajuan_judul', $id)
            ->first();

        $data2 = DB::table('pengajuan_judul')
            ->join('users', 'users.id', 'pengajuan_judul.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
            ->join('users as dosen', 'dosen.id', 'bidang_ilmu.users_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.pengajuan_id', 'pengajuan_judul.id_pengajuan_judul')
            ->select('users.name', 'users.kode_unik', 'pengajuan_judul.*', 'bidang_ilmu.topik_bidang_ilmu', 'dosen.name as nama_dosen', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii')
            ->where('id_pengajuan_judul', $id)
            ->first();

        $dosen2 = DB::table('detail_bidang_ilmu')
            ->join('pengajuan_judul', 'detail_bidang_ilmu.bidang_ilmu_id', 'pengajuan_judul.bidang_ilmu_id')
            ->join('users', 'users.id', 'detail_bidang_ilmu.users_id')
            ->where('pengajuan_judul.id_pengajuan_judul', $id)
            ->get();

        // $mergedData = [
        //     'data' => $data,
        //     'data2' => $data2,
        //     'dosen2' => $dosen2,
        // ];

        return view('koordinator/pengajuan_judul.detail', compact('data','data2', 'dosen2'));
    }


    public function updatestatus2(Request $request, $id_tema)
    {
        try {
            // Validate the request data
            $request->validate([
                'action' => 'required|string|in:terima,tolak',
                'users_id' => 'required|integer',
                'pengajuan_id' => 'required|integer',
                'bidang_ilmu_id' => 'required|integer',
                'dosen_pembimbing_utama' => 'required|string',
                'dosen_pembimbing_ii' => 'required|string',
            ]);

            // Debugging: Dump the request data
            // dd($request->all());

            // Find the PengajuanJudul record
            $pengajuan = PengajuanJudul::findOrFail($id_tema);

            // Update the status of the pengajuan
            $pengajuan->status = $request->input('action');
            $pengajuan->save();

            // Conditionally create BimbinganProposal only when the action is 'terima'
            if ($pengajuan->status === 'terima') {
                $bp = new BimbinganProposal();
                $bp->fill($request->only([
                    'users_id',
                    'pengajuan_id',
                    'bidang_ilmu_id',
                    'dosen_pembimbing_utama',
                    'dosen_pembimbing_ii',
                ]));
                $bp->save();
            }

            return redirect()->route('pengajuan-judul.index')->with('success', 'Status pengajuan diperbarui' . ($pengajuan->status === 'terima' ? ' dan Bimbingan Proposal dibuat.' : '.'));
        } catch (\Exception $e) {
            // Handle the exception, log it, and return a response
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }


}
