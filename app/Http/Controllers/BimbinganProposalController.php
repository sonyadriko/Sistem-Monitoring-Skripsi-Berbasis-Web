<?php

namespace App\Http\Controllers;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\DetailBimbinganProposal as DetailBimbinganProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BimbinganProposalController extends Controller
{
    public function index()
    {
        $dosens = DB::table('bimbingan_proposal')->where('user_id', '=', Auth::user()->id)->first();
        
        return view('mahasiswa/proposal/bimbingan.index', compact('dosens'));

    }

    public function store(Request $request)
    {
                    // dd($request->all());

        $validatedData = $request->validate([
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
        ]);

        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal');
            $fileName = $proposalFilePath->getClientOriginalName(); 
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/bimbingan_proposal/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/bimbingan_proposal/'.$fileName;
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
        
        $bimbingan = new DetailBimbinganProposal();
        $bimbingan->bimbingan_proposal_id = $request['bimbingan_proposal_id'];
        $bimbingan->file = $fileUrl;
        $bimbingan->save();
    
            // return redirect()->back()->with('success', 'File berhasil diunggah.');
        return redirect()->route('bimbingan-mhs.index');
    }
}
