<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SidangSkripsi as SidangSkripsi;
use Illuminate\Support\Facades\Auth;

class SidangSkripsiController extends Controller
{
    public function index()
    {
        // $juduls = Judul::all();
        $datas = DB::table('bimbingan_skripsi')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('users', 'users.id', 'bimbingan_proposal.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->first();
        return view('mahasiswa/skripsi/sidang_skripsi.index', compact('datas'));
    }
    public function store(Request $request)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'skripsi_file' => 'required|mimes:pdf,docx|max:1000',
            'slip_file' => 'required|mimes:pdf,docx|max:1000',
        ], [
            'skripsi_file.required' => 'File skripsi is required.',
            'skripsi_file.mimes' => 'File skripsi must be a PDF or DOCX.',
            'skripsi_file.max' => 'File skripsi may not be greater than 1000 KB.',
            'slip_file.required' => 'File slip pembayaran is required.',
            'slip_file.mimes' => 'File slip pembayaran must be a PDF or DOCX.',
            'slip_file.max' => 'File slip pembayaran may not be greater than 1000 KB.',
        ]);

        // Generate unique file names
        $fileSkripsiName = uniqid() . '.' . $request->file('skripsi_file')->getClientOriginalExtension();
        $fileSlipPembayaranName = uniqid() . '.' . $request->file('slip_file')->getClientOriginalExtension();

        // Move the files to the appropriate directory
        $userFolder = Auth::user()->name;
        $request->file('skripsi_file')->move(public_path("uploads/{$userFolder}/sidang_skripsi/"), $fileSkripsiName);
        $request->file('slip_file')->move(public_path("uploads/{$userFolder}/sidang_skripsi/"), $fileSlipPembayaranName);

        $SidangSkripsi = new SidangSkripsi();
        $SidangSkripsi->users_id= Auth::user()->id;
        $SidangSkripsi->bimbingan_skripsi_id = $request['id_bimbingan_skripsi'];

        $SidangSkripsi->file_skripsi = "uploads/{$userFolder}/sidang_skripsi/{$fileSkripsiName}";
        $SidangSkripsi->file_slip_pembayaran = "uploads/{$userFolder}/sidang_skripsi/{$fileSlipPembayaranName}";
        $SidangSkripsi->save();

        return redirect('/dashboard')->with('success', 'Berhasil Daftar Sidang Skripsi.');

    }
}
