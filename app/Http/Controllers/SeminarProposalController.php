<?php

namespace App\Http\Controllers;
use App\Models\SeminarProposal as SeminarProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SeminarProposalController extends Controller
{
    public function create()
    {
        // $juduls = Judul::all();
        $datas = DB::table('users')
            ->join('pengajuan_judul', 'pengajuan_judul.user_id', 'users.id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.user_id', 'users.id')
            ->join('seminar_proposal', 'seminar_proposal.users_id', 'users.id')
            ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'seminar_proposal.file_proposal', 'seminar_proposal.file_slip_pembayaran', 'seminar_proposal.status', 'seminar_proposal.tanggal')
            ->where('users.id', '=', Auth::user()->id)
            ->where('pengajuan_judul.status', 'terima')
            ->latest('seminar_proposal.created_at')
            ->first();
            $datas2 = DB::table('users')
            ->join('pengajuan_judul', 'pengajuan_judul.user_id', 'users.id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.user_id', 'users.id')
            ->join('seminar_proposal', 'seminar_proposal.users_id', 'users.id')
            ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
            ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'seminar_proposal.file_proposal', 'seminar_proposal.file_slip_pembayaran', 'seminar_proposal.status', 'seminar_proposal.tanggal', 'ruangan.nama_ruangan', 'seminar_proposal.jam', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2')
            ->where('users.id', '=', Auth::user()->id)
            ->where('pengajuan_judul.status', 'terima')
            ->first();
        return view('mahasiswa/proposal/seminar_proposal.index', compact('datas', 'datas2'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'bimbingan_proposal_id' => 'required',
            'proposal_file' => 'required|mimes:pdf|max:1000',
            'slip_file' => 'required|mimes:pdf|max:1000',
        ], [
            'bimbingan_proposal_id.required' => 'Bimbingan Proposal ID is required.',
            'proposal_file.required' => 'File proposal is required.',
            'proposal_file.mimes' => 'File proposal must be a PDF.',
            'proposal_file.max' => 'File proposal may not be greater than 1000 KB.',
            'slip_file.required' => 'File slip pembayaran is required.',
            'slip_file.mimes' => 'File slip pembayaran must be a PDF.',
            'slip_file.max' => 'File slip pembayaran may not be greater than 1000 KB.',
        ]);

        // Generate unique file names
        $fileProposalName = $request->file('proposal_file')->getClientOriginalName();
        // $fileProposalName = uniqid() . '.' . $request->file('proposal_file')->getClientOriginalExtension();
        $fileSlipPembayaranName = $request->file('slip_file')->getClientOriginalName();
        // $fileSlipPembayaranName = uniqid() . '.' . $request->file('slip_file')->getClientOriginalExtension();

        // Move the files to the appropriate directory
        $userFolder = Auth::user()->name;
        $request->file('proposal_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileProposalName);
        $request->file('slip_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileSlipPembayaranName);

        $seminarProposal = new SeminarProposal();
        $seminarProposal->users_id= Auth::user()->id;
        $seminarProposal->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];
        $seminarProposal->status = 'pending';

        $seminarProposal->file_proposal = "uploads/{$userFolder}/seminar_proposal/{$fileProposalName}";
        $seminarProposal->file_slip_pembayaran = "uploads/{$userFolder}/seminar_proposal/{$fileSlipPembayaranName}";
        $seminarProposal->save();

        return redirect('/dashboard')->with('success', 'Berhasil Daftar Seminar Proposal.');

    }
}
