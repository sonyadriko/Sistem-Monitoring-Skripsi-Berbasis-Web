<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judul as Judul;
use Illuminate\Support\Facades\DB;



class KoordinatorJudulController extends Controller
{
    //
    public function index()
    {
        // $juduls = Judul::all();
        $juduls = DB::table('tema')
        ->join('bidang_ilmu', 'bidang_ilmu.id', 'tema.bidang_ilmu_id')
        ->orderBy('tema.created_at', 'desc')->get();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }
    public function detail($id)
    {
        // $data = DB::table('tema')->where('id', $id)->first();
        // $data = Judul::find($id_tema);
        $data = [
            'data' => DB::table('tema')->where('id_tema', '=',$id)->first(),
            'bidang_ilmu' => DB::table('bidang_ilmu')->select('id', 'topik_bidang_ilmu')->get(),
        ];
        // $data = DB::table('tema')->where('id_tema', '=',$id)->first();
        // $bidang_ilmu = DB::table('bidang_ilmu')->select('id', 'topik_bidang_ilmu')->get();
        return view('koordinator/pengajuan_judul.detail', $data);

    }

    public function updatestatus2(Request $request, $id_tema){
        $action = $request->input('action');

    // Temukan data yang sesuai berdasarkan $id
        $data = Judul::find($id_tema);
   

    
        if ($action === 'terima') {
            $data->status = 'terima';
        } elseif ($action === 'tolak') {
            $data->status = 'tolak';
        }
    
        $data->save();

    // Redirect atau kembali ke halaman yang sesuai
    return redirect()->route('pengajuan-judul.index');
    }

    // public function updatestatus($id,Request $request)
    // {
    // $tema = Tema::find($id_tema);
    // if (!$tema) {
    //     return response()->json(['message' => 'Tema not found'], 404);
    // }
    // // Ubah status menjadi "acc"
    // $tema->status = 'acc';
    // $tema->save();

    // return response()->json(['message' => 'Status updated successfully']);
    // }
}
