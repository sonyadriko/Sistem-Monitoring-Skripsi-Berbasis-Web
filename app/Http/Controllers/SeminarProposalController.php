<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeminarProposalController extends Controller
{
    public function create()
    {
        // $juduls = Judul::all();
        return view('mahasiswa/proposal/seminar_proposal.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'proposal_file' => 'required|mimes:pdf,docx|max:1000',
            'slip_file' => 'required|mimes:pdf,docx|max:1000',
        ]);

        if ($request->file('proposal_file')->isValid() && $request->file('slip_pembayaran_file')->isValid()) {
            $proposalFilePath = $request->file('proposal_file')->store('proposals');
            $slipPembayaranFilePath = $request->file('slip_pembayaran_file')->store('slip_pembayaran');
    
            // Simpan informasi file ke basis data atau lakukan sesuatu dengan file tersebut
            // ...
    
            return redirect()->back()->with('success', 'File berhasil diunggah.');
        }
    }
}
