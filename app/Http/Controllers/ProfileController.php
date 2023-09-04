<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUser as DetailUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    //
    public function index()
    {
        // $juduls = DB::table('tema')
        //     ->join('bidang_ilmu', 'bidang_ilmu.id', 'tema.bidang_ilmu_id')
        //     ->orderBy('tema.created_at', 'desc')->get();
        // return view('koordinator/pengajuan_judul.index', compact('juduls'));

        $details = DB::table('detail_users')
            // ->join('users', 'users.id', 'detail_users.user_id')
            ->where('user_id', '=', Auth::user()->id)->first();
        
        return view('/mahasiswa/profile.index', compact('details'));
    }

    public function edit($id){

        $data = [
            'data' => DB::table('detail_users')->where('user_id', '=',$id)->first(),
            // 'bidang_ilmu' => DB::table('bidang_ilmu')->select('id', 'topik_bidang_ilmu')->get(),
        ];
       
        // return view('koordinator/penjadwalan/seminar_proposal.detail', $data);

        return view('/mahasiswa/profile.edit', $data);
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();

        // Validate the form data
        $validatedData = $request->validate([
            'alamat' => 'required',
            'notelpmhs' => 'required|numeric',
            'alamat_orang_tua' => 'required',
            'notelpot' => 'required|numeric',
        ]);

        // Update the user's profile information
        DB::table('detail_users')
        ->where('user_id', '=', $id)
        ->update([
            'alamat_mhs' => $validatedData['alamat'],
            'no_telp_mhs' => $validatedData['notelpmhs'],
            'alamat_orang_tua' => $validatedData['alamat_orang_tua'],
            'no_telp_orang_tua' => $validatedData['notelpot'],
        ]);

        // return redirect()->back()->with('success', 'Profile updated successfully');
        return redirect('/dashboard');


    
    }
}
