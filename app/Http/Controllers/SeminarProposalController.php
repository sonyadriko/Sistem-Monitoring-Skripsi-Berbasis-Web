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
        $validatedData = $request->validate([
            'tema_id' => 'required',


            'proposal_file' => 'required|mimes:pdf,docx|max:1000',
            'slip_file' => 'required|mimes:pdf,docx|max:1000',

        ]);


        if ($request->hasFile('proposal_file')) {
            $proposalFilePath = $request->file('proposal_file')->store('uploads');
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
    
        // Simpan file slip pembayaran
        if ($request->hasFile('slip_file')) {
            $slipPembayaranFilePath = $request->file('slip_file')->store('uploads');
        } else {
            return redirect()->back()->with('error', 'File slip pembayaran tidak valid.');
        }

        $seminarProposal = new SeminarProposal();
        $seminarProposal->user_id=Auth::user()->id;
        $seminarProposal->file_proposal = $proposalFilePath;
        $seminarProposal->file_slip_pembayaran = $slipPembayaranFilePath;
        $seminarProposal->save();

        return redirect()->route('/home');

    }
}
