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


        $temas = DB::table('tema')->where('status', '=', 'terima')->get();

        return view('koordinator/pembagian_dosen.index', compact('temas'));

    }



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
            'users_id' => 'required',
        ], [
            'tema_id.required' => 'tema_id is required.',
            'dospem_1.required' => 'dospem_1 is required.',
            'dospem_2.required' => 'dospem_2 is required.',
            'users_id.required' => 'users_id is required.',

        ]);
        $action = $request->input('action');
        $id_tema = $request->input('id_tema');


        $data = DB::table('tema')->where('id_tema', '=', $validatedData['tema_id']);

        if ($action === 'sudah') {
            $data->update(['dosen' => 'sudah']);
        }


        $bagis = new Dosen();
        $bagis->tema_id = $validatedData['tema_id'];
        $bagis->users_id = $validatedData['users_id'];
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
