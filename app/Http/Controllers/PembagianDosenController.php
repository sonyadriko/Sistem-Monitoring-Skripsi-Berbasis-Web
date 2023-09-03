<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen as Dosen;
use App\Models\Judul as Judul;
use Illuminate\Support\Facades\DB;




class PembagianDosenController extends Controller
{
    public function index()
    {
        // $juduls = Judul::all();
        // $juduls = DB::table('tema')
        // ->join('bidang_ilmu', 'bidang_ilmu.id', 'tema.bidang_ilmu_id')
        // ->orderBy('tema.created_at', 'desc')->get();
        // return view('koordinator/pengajuan_judul.index', compact('juduls'));
        // $dosens = Dosen::all();
        $dosens = DB::table('dosen')
        ->join('tema', 'tema.id_tema', 'dosen.tema_id')
        ->orderBy('dosen.created_at', 'desc')->get();
        // $juduls = DB::table('tema')->where('status', '=', 'terima')->get();
        
        return view('koordinator/pembagian_dosen.index', compact('dosens'));

    }

    public function create()
    {
        $juduls = DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', null)->get();
        // $dosens = Dosen::all();

        return view('koordinator/pembagian_dosen.create', compact('juduls'));

    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'npm' => 'required|string',
            'dospem_1' => 'required|string',
            'dospem_2' => 'required|string',
        ], [
            'npm.required' => 'npm is required.',
            'dospem_1.required' => 'dospem_1 is required.',
            'dospem_2.required' => 'dospem_2 is required.',
        ]);    
        // $data = Judul::find($id_tema);

        $action = $request->input('action');
        $id_tema = $request->input('id_tema');

        
        $data = DB::table('tema')->where('id_tema', '=', $validatedData['npm']);
       
        if ($action === 'sudah') {
            $data->update(['dosen' => 'sudah']);
        }


        $bagis = new Dosen();
        $bagis->npm = $validatedData['npm'];
        $bagis->dospem_1 = $validatedData['dospem_1'];
        $bagis->dospem_2 = $validatedData['dospem_2'];
        $bagis->save();

        return redirect('/koordinator/pembagian_dosen');
    }
}
