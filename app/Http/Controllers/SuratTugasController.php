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
        ->join('tema', 'tema.user_id', '=', 'users.id')
        ->select('users.*', 'tema.*')
        ->where('users.id', '=', Auth::user()->id)
        ->first();
        return view('mahasiswa/proposal/surat_tugas.index', compact('datas'));
    }
        // dd(request()->all());
    public function store(Request $request)
    {
        // dd(request()->all());

        $validatedData = $request->validate([
            'detail_users_id' => 'required',
            'tema_id' => 'required',
            'dosen_id' => 'required',
            'user_id' => 'required',
            'tanggal_sidang_proposal' => 'required|date',
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'file_slip_pembayaran' => 'required|mimes:pdf,docx|max:1000',
        ], [
            'detail_users_id.required' => 'detail_users_id is required.',
            'tema_id.required' => 'tema_id is required.',
            'user_id.required' => 'user_id is required.',
            'dosen_id.required' => 'dosen_id is required.',
            'tanggal_sidang_proposal.required' => 'tanggal_sidang_proposal is required.',
            'file_proposal.required' => 'file_proposal is required.',
            'file_slip_pembayaran.required' => 'file_slip_pembayaran is required.',
        ]);    
        $userFolder = 'uploads/' . Auth::user()->name;
        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal')->store($userFolder);
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
    
        if ($request->hasFile('file_slip_pembayaran')) {
            $slipPembayaranFilePath = $request->file('file_slip_pembayaran')->store($userFolder);
        } else {
            return redirect()->back()->with('error', 'File slip pembayaran tidak valid.');
        }

        $datau = new SuratTugas();
        $datau->user_id = $validatedData['user_id'];
        $datau->detail_users_id=$validatedData['detail_users_id'];
        $datau->tema_id=$validatedData['tema_id'];
        $datau->dosen_id=$validatedData['dosen_id'];
        $datau->tanggal_sidang_proposal=$validatedData['tanggal_sidang_proposal'];
        $datau->file_proposal = $proposalFilePath;
        $datau->file_slip_pembayaran = $slipPembayaranFilePath;
        $datau->save();

        return redirect('/proposal');
    }
}
