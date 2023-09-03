<?php

namespace App\Http\Controllers;
use App\Models\BimbinganProposal as BimbinganProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BimbinganProposalController extends Controller
{
    public function index()
    {
        // $juduls = Judul::all();
        
        return view('mahasiswa/proposal/bimbingan.index');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'komentar' => 'string',
        ]);

        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal')->store('uploads/'.Auth::user()->name);
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }

        $bimbingan = new BimbinganProposal();
        $bimbingan->user_id=Auth::user()->id;
        $bimbingan->file_proposal=$proposalFilePath;
        $bimbingan->komentar = $validatedData['komentar'];
        // $bimbingan->file_slip_pembayaran = $slipPembayaranFilePath;
        $bimbingan->save();
    
            // return redirect()->back()->with('success', 'File berhasil diunggah.');
        return redirect()->route('bimbingan-mhs.index');
    }
}
