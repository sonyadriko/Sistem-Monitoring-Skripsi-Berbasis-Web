<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;  
use App\Models\SuratTugas as SuratTugas;



class KoordinatorSuratTugasController extends Controller
{
    public function index()
    {
        $surattugas = DB::table('surat_tugas')->join('users', 'users.id', 'surat_tugas.user_id')->get();
     
        return view('koordinator/surat_tugas.index', compact('surattugas'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('surat_tugas')
                ->join('users', 'users.id', 'surat_tugas.user_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'surat_tugas.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->join('seminar_proposal', 'seminar_proposal.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
                ->where('id_surat_tugas', $id)
                ->first(),
        ];
        return view('koordinator/surat_tugas.detail', $data);
    }

    public function update($id, Request $request)
    {
        $data = SuratTugas::where('id_surat_tugas', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        // endapatkan nomor surat terakhir
        $lastNumber = DB::table('surat_tugas')->max('nomor_surat_tugas');

        $lastNumber = (int)substr($lastNumber, strlen('ITATS/FORM/SPM/'));

        $prefix = 'ITATS/FORM/SPM/';
        $nextNumber = $lastNumber + 1;
        $nomorSuratLengkap = $prefix . (string)$nextNumber; // Mengonversi nomor surat ke string sebelum menggabungkannya

        // Set nilai nomor surat pada data yang akan disimpan
        $data->nomor_surat_tugas = $nomorSuratLengkap;
        $data->tanggal_terbit = Carbon::now();
        $data->tanggal_kadaluwarsa = Carbon::now()->addMonths(6);

        // Simpan data ke database
        $data->save();

        return redirect()->back()->with('success', 'Data updated successfully.');
        
    }
}
