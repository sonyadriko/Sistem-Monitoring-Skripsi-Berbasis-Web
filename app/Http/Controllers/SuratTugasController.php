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
        // $juduls = Judul::all();
        // $datas = DB::table('detail_users')
        // ->join('tema', 'tema.user_id', '=', 'detail_users.user_id')
        // ->select('detail_users.*', 'tema.judul')
        // ->where('detail_users.user_id', '=', Auth::user()->id);

        $datas = DB::table('detail_users')
        ->join('tema', 'tema.user_id', '=', 'detail_users.user_id')
        ->join('dosen', 'dosen.user_id', '=', 'detail_users.user_id')
        ->select('detail_users.*', 'tema.*', 'dosen.*')
        ->where('detail_users.user_id', '=', Auth::user()->id)
        ->first();



        return view('mahasiswa/proposal/surat_tugas.index', compact('datas'));

    }

        // dd(request()->all());
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'detail_users_id' => 'required',
            'tema_id' => 'required',
            'dosen_id' => 'required',
            'tanggal_sidang_proposal' => 'required',
            'file_proposal' => 'required|mimes:pdf,docx|max:1000',
            'file_slip_pembayaran' => 'required|mimes:pdf,docx|max:1000',
        ], [
            'tanggal_sidang_proposal.required' => 'tema_id is required.',
            'file_proposal.required' => 'dospem_1 is required.',
            'file_slip_pembayaran.required' => 'dospem_2 is required.',
        ]);    
        if ($request->hasFile('file_proposal')) {
            $proposalFilePath = $request->file('file_proposal')->store('uploads/'.Auth::user()->name);
        } else {
            return redirect()->back()->with('error', 'File proposal tidak valid.');
        }
    
        if ($request->hasFile('file_slip_pembayaran')) {
            $slipPembayaranFilePath = $request->file('file_slip_pembayaran')->store('uploads/'.Auth::user()->name);
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
