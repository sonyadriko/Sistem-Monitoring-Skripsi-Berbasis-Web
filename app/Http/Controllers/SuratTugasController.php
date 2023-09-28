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
        ->where('users.id', Auth::user()->id)
        ->first();
        return view('mahasiswa/proposal/surat_tugas.index', compact('datas'));
    }
    public function store(Request $request)
    {
        // dd(request()->all());

        $validatedData = $request->validate([
            
            'user_id' => 'required',
            'bimbingan_proposal_id' => 'required',

            'tanggal_sidang_proposal' => 'required|date',
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'file_slip_pembayaran' => 'required|mimes:pdf,docx|max:1000',
        ], [
           
            'user_id.required' => 'user_id is required.',
            'bimbingan_proposal_id.required' => 'bimbingan_proposal_id is required.',

            'tanggal_sidang_proposal.required' => 'tanggal_sidang_proposal is required.',
            'file_proposal.required' => 'file_proposal is required.',
            'file_slip_pembayaran.required' => 'file_slip_pembayaran is required.',
        ]);    

        

        $userFolder = 'uploads/' . Auth::user()->name;
        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal');
            $fileName = $proposalFilePath->getClientOriginalName(); 
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/surat_tugas/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/surat_tugas/'.$fileName;

        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
    
        if ($request->hasFile('file_slip_pembayaran')) {
            $slipPembayaranFilePath = $request->file('file_slip_pembayaran');
            $fileName = $slipPembayaranFilePath->getClientOriginalName(); 
            $userFolder = Auth::user()->name;
            $slipPembayaranFilePath->move(public_path('uploads/'.$userFolder.'/surat_tugas/'), $fileName);
            $fileUrl2 = 'uploads/'.$userFolder.'/surat_tugas/'.$fileName;
        } else {
            return redirect()->back()->with('error', 'File slip pembayaran tidak valid.');
        }

        $datau = new SuratTugas();
        $datau->user_id = $validatedData['user_id'];
        $datau->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];

        // $datau->tema_id=$validatedData['tema_id'];
        // $datau->dosen_id=$validatedData['dosen_id'];
        $datau->tanggal_sidang_proposal=$validatedData['tanggal_sidang_proposal'];
        $datau->file_proposal = $fileUrl;
        $datau->file_slip_pembayaran = $fileUrl2;
        $datau->save();

        return redirect('/proposal');
    }
}
