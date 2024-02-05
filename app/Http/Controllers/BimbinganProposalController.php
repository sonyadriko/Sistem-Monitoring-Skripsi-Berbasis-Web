<?php

namespace App\Http\Controllers;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\DetailBimbinganProposal as DetailBimbinganProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BimbinganProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
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
    try {
        $validatedData = $request->validate([
            'file_proposal' => 'required|mimes:pdf|max:5000',
        ]);

        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal');
            $fileName = $proposalFilePath->getClientOriginalName();
            $userFolder = Auth::user()->name;

            // Gunakan try-catch di sini untuk menangani kesalahan penyimpanan file
            try {
                $proposalFilePath->move(public_path('uploads/'.$userFolder.'/bimbingan_proposal/'), $fileName);
                $fileUrl = 'uploads/'.$userFolder.'/bimbingan_proposal/'.$fileName;
            } catch (\Exception $e) {
                throw new \Exception('Gagal menyimpan file. ' . $e->getMessage());
            }
        } else {
            throw new \Exception('File proposal tidak valid.');
        }

        $bimbingan = new DetailBimbinganProposal();
        $bimbingan->bimbingan_proposal_id = $request->input('bimbingan_proposal_id');
        $bimbingan->file = $fileUrl;
        $bimbingan->save();

        return response()->json(['success' => true, 'message' => 'File berhasil diunggah.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}




}
