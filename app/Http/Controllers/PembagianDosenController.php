<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen as Dosen;
use App\Models\Judul as Judul;
use App\Models\User as User;

use Illuminate\Support\Facades\DB;




class PembagianDosenController extends Controller
{
    public function index()
    {
      
        // $dosens = DB::table('dosen')
        // ->join('tema', 'tema.id_tema', 'dosen.tema_id')
        // ->select('dosen.*', 'tema.*')
        // ->orderBy('dosen.created_at', 'desc')
        // ->get();

        $temas = DB::table('tema')->where('status', '=', 'terima')->get();
        
        return view('koordinator/pembagian_dosen.index', compact('temas'));

    }

    // public function create()
    // {
    //     $juduls = DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', null)->get();
    //     $tema = DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', 'belum')->get();

    //     $users = DB::table('users')->where('role_id', '=', '2')->get();
    //     // $dosens = Dosen::all();

    //     return view('koordinator/pembagian_dosen.create', compact('juduls', 'users', 'tema'));

    // }

    public function edit($id)
    {
        $data = [
            'juduls' => DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', 'belum')->get(),
            'users' => DB::table('users')->where('role_id', '=', '2')->get(),
            'tema' => DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', 'belum')->where('id_tema', '=', $id)->first(),
        ];
       

        return view('koordinator/pembagian_dosen.create', $data);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'tema_id' => 'required|string',
            'dospem_1' => 'required|string',
            'dospem_2' => 'required|string',
            'user_id' => 'required',
        ], [
            'tema_id.required' => 'tema_id is required.',
            'dospem_1.required' => 'dospem_1 is required.',
            'dospem_2.required' => 'dospem_2 is required.',
            'user_id.required' => 'user_id is required.',

        ]);    
        // $data = Judul::find($id_tema);

        $action = $request->input('action');
        $id_tema = $request->input('id_tema');

        
        $data = DB::table('tema')->where('id_tema', '=', $validatedData['tema_id']);
       
        if ($action === 'sudah') {
            $data->update(['dosen' => 'sudah']);
        }


        $bagis = new Dosen();
        $bagis->tema_id = $validatedData['tema_id'];
        $bagis->user_id = $validatedData['user_id'];
        $bagis->dospem_1 = $validatedData['dospem_1'];
        $bagis->dospem_2 = $validatedData['dospem_2'];
        $dospem1 = User::find($validatedData['dospem_1']);
        $dospem2 = User::find($validatedData['dospem_2']);
        
        $bagis->nama_dospem1 = $dospem1 ? $dospem1->name : 'Tidak Ada';
        $bagis->nama_dospem2 = $dospem2 ? $dospem2->name : 'Tidak Ada';
        $bagis->save();

        return redirect('/koordinator/pembagian_dosen');
    }

    // public function detail($id)
    // {
    //     $data = [
    //         'juduls' => DB::table('tema')->where('status', '=', 'terima')->where('dosen', '=', 'belum')->get(),
    //         'users' => DB::table('users')->where('role_id', '=', '2')->first(),
    //         'dosens' => DB::table('dosen')->first(),
    //         'tema' => DB::table('tema')->where('status', '=', 'terima')d->where('id_tema', '=', $id)->first(),
    //     ];
       

    //     return view('koordinator/pembagian_dosen.detail', $data);
    // }
}
