<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SuratSurveyPerusahaan as SuratSurvey;
use Illuminate\Support\Facades\Auth;

class SuratSurveyController extends Controller
{
    //
    public function index()
    {
        $ss = DB::table('bimbingan_proposal')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->where('bimbingan_proposal.user_id', Auth::user()->id)
            ->first();

        return view('mahasiswa/surat_survey.index', compact('ss'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_perusahaan' => 'required|string',
            'nama_penerima' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'durasi_survey' => 'required|integer',
        ]);

        // Concatenate the word "bulan" to the 'durasi' field
        $durasiSurvey = $validatedData['durasi_survey'] . ' bulan';

        $suratSurvey = new SuratSurvey([
            'users_id' => Auth::user()->id,
            'bimbingan_proposal_id' => $request->input('bimbingan_proposal_id'),
            'nama_instansi' => $validatedData['nama_perusahaan'],
            'nama_penerima' => $validatedData['nama_penerima'],
            'alamat_instansi' => $validatedData['alamat_perusahaan'],
            'durasi' => $durasiSurvey,
        ]);

        $suratSurvey->save();

        return redirect('/dashboard')->with('success', 'Pengajuan Surat Survey Berhasil.');
    }
}
