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
            'durasi_survey' => 'required|integer', // Assuming you want an integer value
        ]);

        // Create a new instance of the model and fill it with the validated data
        $pengajuanJudul = new SuratSurvey($validatedData);

        // Save the model instance to the database
        $pengajuanJudul->save();

        // Redirect or return a response as needed
        return redirect()->route('surat-survey.index');
    }
}
