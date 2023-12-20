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
        $dosens = DB::table('bimbingan_proposal')
        ->where('users_id', Auth::user()->id)
        ->first();

        $detailbim = DB::table('detail_bimbingan_proposal')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'detail_bimbingan_proposal.bimbingan_proposal_id')
            ->where('users_id', Auth::user()->id)
            ->latest('detail_bimbingan_proposal.created_at') // Order by the creation timestamp in descending order
            ->first();

    return view('mahasiswa/proposal/bimbingan.index', compact('dosens', 'detailbim'));


    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_proposal' => 'required|mimes:pdf|max:5000',
            'file_proposal.required' => 'File proposal wajib diunggah.',
            'file_proposal.mimes' => 'Tipe file harus pdf.',
            'file_proposal.max' => 'Ukuran file melebihi batas maksimum (5000 KB).',
        ]);

        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal');
            // $fileName = uniqid() . '.' . $proposalFilePath->getClientOriginalExtension();
            $fileName = $proposalFilePath->getClientOriginalName();
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/bimbingan_proposal/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/bimbingan_proposal/'.$fileName;
        } else {
            return response()->json(['success' => false, 'message' => 'File proposal tidak valid.']);
        }

        $bimbingan = new DetailBimbinganProposal();
        $bimbingan->bimbingan_proposal_id = $request->input('bimbingan_proposal_id'); // Sesuaikan ini dengan input yang benar
        $bimbingan->file = $fileUrl;
        $bimbingan->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'File berhasil diunggah.']);
        // return redirect('/dashboard')->with('success', 'Pengajuan berhasil dilakukan.');

    }



}
