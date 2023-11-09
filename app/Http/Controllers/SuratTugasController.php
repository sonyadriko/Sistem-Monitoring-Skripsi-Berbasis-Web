<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SuratTugas as SuratTugas;


class SuratTugasController extends Controller
{
    public function index()
{
    $datas = DB::table('users')
        ->join('bimbingan_proposal', 'bimbingan_proposal.user_id', 'users.id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->join('berita_acara_proposal', 'berita_acara_proposal.users_id', 'users.id')
        ->where('users.id', Auth::user()->id)
        ->first();

    // Check if $datas is null before passing it to the view
    if (!$datas) {
        // Handle the case where data is not found
        return view('mahasiswa/proposal/surat_tugas.index')->with('datas', null);
    }

    return view('mahasiswa/proposal/surat_tugas.index', compact('datas'));
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'bimbingan_proposal_id' => 'required|numeric',
            'tanggal_sidang_proposal' => 'required|date',
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'file_slip_pembayaran' => 'required|mimes:pdf,docx|max:1000',
        ], [
            'user_id.required' => 'User ID is required.',
            'bimbingan_proposal_id.required' => 'Bimbingan Proposal ID is required.',
            'file_proposal.required' => 'File proposal is required.',
            'file_proposal.mimes' => 'File proposal must be a PDF or DOCX.',
            'file_proposal.max' => 'File proposal may not be greater than 1000 KB.',
            'file_slip_pembayaran.required' => 'File slip pembayaran is required.',
            'file_slip_pembayaran.mimes' => 'File slip pembayaran must be a PDF or DOCX.',
            'file_slip_pembayaran.max' => 'File slip pembayaran may not be greater than 1000 KB.',

        ]);

        // Generate unique file names
        $fileProposalName = uniqid() . '.' . $request->file('file_proposal')->getClientOriginalExtension();
        $fileSlipPembayaranName = uniqid() . '.' . $request->file('file_slip_pembayaran')->getClientOriginalExtension();

        // Move the files to the appropriate directory
        $userFolder = Auth::user()->name;
        $request->file('file_proposal')->move(public_path("uploads/{$userFolder}/surat_tugas/"), $fileProposalName);
        $request->file('file_slip_pembayaran')->move(public_path("uploads/{$userFolder}/surat_tugas/"), $fileSlipPembayaranName);

        // Create a new SuratTugas instance
        $suratTugas = new SuratTugas();
        $suratTugas->user_id = $validatedData['user_id'];
        $suratTugas->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];
        $suratTugas->tanggal_sidang_proposal = $validatedData['tanggal_sidang_proposal'];
        $suratTugas->file_proposal = "uploads/{$userFolder}/surat_tugas/{$fileProposalName}";
        $suratTugas->file_slip_pembayaran = "uploads/{$userFolder}/surat_tugas/{$fileSlipPembayaranName}";

        // Save to the database
        $suratTugas->save();

        return redirect('/proposal')->with('success', 'Surat Tugas successfully created.');
    }
}
