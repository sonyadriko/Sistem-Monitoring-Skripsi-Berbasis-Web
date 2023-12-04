<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RevisiSeminarProposal as RevisiSeminarProposal;
use App\Models\DetailRevisiSeminarProposal as DetailRevisiSeminarProposal;


class RevisiSeminarProposalController extends Controller
{
    //
    public function index()
    {

        $revisisp = DB::table('detail_berita_acara_proposal')
        ->select('detail_berita_acara_proposal.*', 'berita_acara_proposal.id_berita_acara_p', 'users.*', 'revisi_seminar_proposal.*')
        ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', '=', 'detail_berita_acara_proposal.berita_acara_proposal_id')
        ->join('users', 'users.id', '=', 'detail_berita_acara_proposal.users_id')
        ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
        ->where('berita_acara_proposal.users_id', Auth::user()->id)
        ->first();

        $revisisp2 = DB::table('detail_berita_acara_proposal')
        ->select('detail_berita_acara_proposal.*', 'berita_acara_proposal.id_berita_acara_p', 'users.*')
        ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', '=', 'detail_berita_acara_proposal.berita_acara_proposal_id')
        ->join('users', 'users.id', '=', 'detail_berita_acara_proposal.users_id')
        ->where('berita_acara_proposal.users_id', Auth::user()->id)
        ->get();

        return view('mahasiswa/proposal/revisi.index', compact('revisisp', 'revisisp2')) ;

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_revisi_proposal' => 'required|mimes:pdf|max:1000',
            'file_revisi_proposal.required' => 'File proposal wajib diunggah.',
            'file_revisi_proposal.mimes' => 'Tipe file harus pdf.',
            'file_revisi_proposal.max' => 'Ukuran file melebihi batas maksimum (1000 KB).',
        ]);

        if ($request->hasFile('file_revisi_proposal')) {
            $proposalFilePath = $request->file('file_revisi_proposal');
            // $fileName = uniqid() . '.' . $proposalFilePath->getClientOriginalExtension();
            $fileName = $proposalFilePath->getClientOriginalName();
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/revisi_seminar/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/revisi_seminar/'.$fileName;
        } else {
            return response()->json(['success' => false, 'message' => 'File proposal tidak valid.']);
        }

        $detailrevisi = new DetailRevisiSeminarProposal();
        $detailrevisi->revisi_seminar_proposal_id = $request->input('berita_acara_id');
        $detailrevisi->file_revisi = $fileUrl;
        $detailrevisi->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'File revisi berhasil diunggah.']);
    }
}
