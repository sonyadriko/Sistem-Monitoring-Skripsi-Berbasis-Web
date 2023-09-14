<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan as Pengajuan;
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
            'data' => DB::table('tema')->where('id_tema', '=',$id)->first(),
            'bidang_ilmu' => DB::table('bidang_ilmu')->select('id_bidang_ilmu', 'topik_bidang_ilmu')->get(),
            
        ];
        return view('koordinator/pengajuan_judul.detail', $data);

    }

    public function updatestatus2(Request $request, $id_tema){
        $action = $request->input('action');

    // Temukan data yang sesuai berdasarkan $id
        $data = Pengajuan::find($id_tema);
   

    
        if ($action === 'terima') {
            $data->status = 'terima';
        } elseif ($action === 'tolak') {
            $data->status = 'tolak';
        }
    
        $data->save();

    // Redirect atau kembali ke halaman yang sesuai
    return redirect()->route('pengajuan-judul.index');
    }
}
