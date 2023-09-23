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
            // 'nama' => 'required|string',
            // 'npm' => 'required|string',
            // 'dosen_id' => 'required',
            'tema_id' => 'required',


            'proposal_file' => 'required|mimes:pdf,docx|max:1000',
            'slip_file' => 'required|mimes:pdf,docx|max:1000',

        ]);

        // $filename = time().'.'.$request->proposal_file->extension();
        // $filename2 = time().'.'.$request->slip_file->extension();

        // $request->proosal_file->move(public_path('uploads'), $filename);
        // $request->slip_file->move(public_path('uploads'), $filename2);

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



        // if ($request->file('proposal_file')->isValid() && $request->file('slip_pembayaran_file')->isValid()) {
        //     $proposalFilePath = $request->file('proposal_file')->store('proposals');
        //     $slipPembayaranFilePath = $request->file('slip_pembayaran_file')->store('slip_pembayaran');
    
            $seminarProposal = new SeminarProposal();
            // $seminarProposal->nama=$validatedData['nama'];
            // $seminarProposal->npm=$validatedData['npm'];
            $seminarProposal->user_id=Auth::user()->id;
            // $seminarProposal->dosen_id=$validatedData['dosen_id'];
            // $seminarProposal->tema_id=$validatedData['tema_id'];
            $seminarProposal->file_proposal = $proposalFilePath;
            $seminarProposal->file_slip_pembayaran = $slipPembayaranFilePath;

            // Setelah itu, Anda dapat menambahkan field lain sesuai kebutuhan
            // $seminarProposal->field_name = $fieldValue;

             $seminarProposal->save();
    
            // return redirect()->back()->with('success', 'File berhasil diunggah.');
            return redirect()->route('/home');

        // }
    }
}
