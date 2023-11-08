<?php

namespace App\Http\Controllers;
use App\Models\SeminarProposal as SeminarProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SeminarProposalController extends Controller
{
    public function create()
    {
        // $juduls = Judul::all();
        $datas = DB::table('users')
            ->join('tema', 'tema.user_id', '=', 'users.id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.user_id', 'users.id')
            ->select('users.*', 'tema.*', 'bimbingan_proposal.*')
            ->where('users.id', '=', Auth::user()->id)
            ->where('tema.status', '=', 'terima')
            ->first();
        return view('mahasiswa/proposal/seminar_proposal.index', compact('datas'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'bimbingan_proposal_id' => 'required',
            'proposal_file' => 'required|mimes:pdf,docx|max:1000',
            'slip_file' => 'required|mimes:pdf,docx|max:1000',
        ], [
            'bimbingan_proposal_id.required' => 'Bimbingan Proposal ID is required.',
            'proposal_file.required' => 'File proposal is required.',
            'proposal_file.mimes' => 'File proposal must be a PDF or DOCX.',
            'proposal_file.max' => 'File proposal may not be greater than 1000 KB.',
            'slip_file.required' => 'File slip pembayaran is required.',
            'slip_file.mimes' => 'File slip pembayaran must be a PDF or DOCX.',
            'slip_file.max' => 'File slip pembayaran may not be greater than 1000 KB.',
        ]);

        // Generate unique file names
        $fileProposalName = uniqid() . '.' . $request->file('proposal_file')->getClientOriginalExtension();
        $fileSlipPembayaranName = uniqid() . '.' . $request->file('slip_file')->getClientOriginalExtension();

        // Move the files to the appropriate directory
        $userFolder = Auth::user()->name;
        $request->file('proposal_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileProposalName);
        $request->file('slip_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileSlipPembayaranName);

        $seminarProposal = new SeminarProposal();
        $seminarProposal->users_id= Auth::user()->id;
        $seminarProposal->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];

        $seminarProposal->file_proposal = "uploads/{$userFolder}/seminar_proposal/{$fileProposalName}";
        $seminarProposal->file_slip_pembayaran = "uploads/{$userFolder}/seminar_proposal/{$fileSlipPembayaranName}";
        $seminarProposal->save();

        return redirect('/proposal')->with('success', 'Berhasil Daftar Seminar Proposal.');

    }
}
