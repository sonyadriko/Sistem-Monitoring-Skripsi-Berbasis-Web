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
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')
        ->orderBy('tema.created_at', 'desc')->get();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('tema')->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'tema.bidang_ilmu_id')->select('tema.*', 'bidang_ilmu.topik_bidang_ilmu')->where('id_tema', '=',$id)->first(), 
        ];
        $dosen2 = [
            'dosen2' => DB::table('users')->where('role_id', '2')->get(),
        ];
        return view('koordinator/pengajuan_judul.detail', $data, $dosen2);

    }

    public function updatestatus2(Request $request, $id_tema){
       

        // $validatedData = $request->validate([
        //     'user_id' => 'required',
        //     'tema_id' => 'required',
        //     'dosen_pembimbing_utama' => 'required',
        // ]);

        $action = $request->input('action');
        $data = Pengajuan::find($id_tema);
        // $data = DB::table('tema')->where('id_tema', '=', $id_tema);

        if ($action === 'terima') {
            $data->status = 'terima';
            // $data->update(['status' => 'terima']);

        } elseif ($action === 'tolak') {
            // $data->update(['status' => 'tidak']);

            $data->status = 'tolak';
        }
        $data->save();

        // $data->update(['status' => 'tidak']);

        $bp = new BimbinganProposal();
        $bp->user_id = $request['user_id'];
        $bp->tema_id = $request['tema_id'];
        $bp->bidang_ilmu_id = $request['bidang_ilmu_id'];
        $bp->dosen_pembimbing_utama = $request['dosen_pembimbing_utama'];
        $bp->dosen_pembimbing_ii = $request['dosen_penguji_ii'];
        $bp->save();



        return redirect()->route('pengajuan-judul.index');
    }
}
