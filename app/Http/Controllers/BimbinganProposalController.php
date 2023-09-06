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
        $dosens = DB::table('dosen')->where('user_id', '=', Auth::user()->id)->first();
        
        return view('mahasiswa/proposal/bimbingan.index', compact('dosens'));

    }

    public function store(Request $request)
    {
                    // dd($request->all());

        $validatedData = $request->validate([
            'dosen_id' => 'required',
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'komentar' => 'string',
        ]);

        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal');
            $fileName = $proposalFilePath->getClientOriginalName(); 
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/bimbingan_proposal/'), $fileName);
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
        
        $bimbingan = new BimbinganProposal();
        $bimbingan->user_id = Auth::user()->id;
        $bimbingan->dosen_id = $validatedData['dosen_id'];
        $bimbingan->file_proposal = $proposalFilePath;
        $bimbingan->komentar = $validatedData['komentar'];
        $bimbingan->save();
    
            // return redirect()->back()->with('success', 'File berhasil diunggah.');
        return redirect()->route('bimbingan-mhs.index');
    }
}
