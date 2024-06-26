<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUser as DetailUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
    public function index()
    {

        $details = DB::table('users')
            ->where('id', '=', Auth::user()->id)->first();

        return view('/mahasiswa/profile.index', compact('details'));
    }

    public function edit($id){

        $data = [
            'data' => DB::table('users')->where('id', '=',$id)->first(),
        ];

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
        DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'alamat_mhs' => $validatedData['alamat'],
            'no_telp_mhs' => $validatedData['notelpmhs'],
            'alamat_orang_tua' => $validatedData['alamat_orang_tua'],
            'no_telp_orang_tua' => $validatedData['notelpot'],
            'updated_at' => now()
        ]);

        // return redirect()->back()->with('success', 'Profile updated successfully');
        return redirect('/dashboard')->with('success', 'Profil berhasil diperbarui');

    }
}