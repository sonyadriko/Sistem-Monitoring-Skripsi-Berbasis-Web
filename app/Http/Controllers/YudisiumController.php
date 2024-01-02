<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Yudisium as Yudisium;

class YudisiumController extends Controller
{
    public function index()
    {
        $datas = DB::table('users')
            ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('berita_acara_proposal', 'berita_acara_proposal.users_id', 'users.id')
            ->join('detail_berita_acara_proposal', 'detail_berita_acara_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
            ->leftjoin('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->where('users.id', Auth::user()->id)
            ->first();

        // Check if $datas is null before passing it to the view
        if (!$datas) {
            // Handle the case where data is not found
            return view('mahasiswa/yudisium.index')->with('datas', null);
        }

        return view('mahasiswa/yudisium.index', compact('datas'));
    }

    public function checkStatus()
    {
        $datas = DB::table('users')
        ->join('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->join('yudisium', 'yudisium.users_id', 'users.id')
        ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*')
        ->where('users.id', Auth::user()->id)
        ->where('pengajuan_judul.status', 'terima')
        ->first();

        $userData = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        $proposalData = DB::table('pengajuan_judul')
            ->leftJoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'pengajuan_judul.users_id')
            ->leftJoin('seminar_proposal', 'seminar_proposal.users_id', 'pengajuan_judul.users_id')
            ->leftJoin('bimbingan_skripsi', 'bimbingan_skripsi.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
            ->leftJoin('yudisium', 'yudisium.users_id', 'pengajuan_judul.users_id')
            ->select('pengajuan_judul.*', 'bimbingan_skripsi.id_bimbingan_skripsi', 'yudisium.id_yudisium', 'bimbingan_proposal.dosen_pembimbing_ii', 'bimbingan_proposal.acc_dosen_utama', 'bimbingan_proposal.acc_dosen_ii', 'seminar_proposal.id_seminar_proposal', 'seminar_proposal.status as seminar_status', 'bimbingan_proposal.dosen_pembimbing_utama')
            ->where('pengajuan_judul.users_id', Auth::user()->id)
            ->latest('seminar_proposal.created_at')
            ->first();

        if (is_null($proposalData) || is_null($proposalData->id_bimbingan_skripsi)) {
            return view('mahasiswa/yudisium.no_submission');
        } elseif($proposalData->dosen_pembimbing_ii == 'tidak ada'){
            if(is_null($proposalData->acc_dosen_utama)) {
                return view('mahasiswa/yudisium.no_acc');
            }elseif (is_null($proposalData->id_yudisium)) {
                return view('mahasiswa/yudisium.submit_form', compact('userData', 'datas'));
            } else {
                return redirect()->route('yudisium.status', $proposalData->id_yudisium);
            }
        } elseif(is_null($proposalData->acc_dosen_utama) || is_null($proposalData->acc_dosen_ii)){
            return view('mahasiswa/yudisium.no_acc');
        } elseif (is_null($proposalData->id_yudisium)) {
            return view('mahasiswa/yudisium.submit_form', compact('userData', 'datas'));
        } else {
            return redirect()->route('yudisium.status', $proposalData->id_yudisium);
        }
    }

    public function showStatus($id)
    {
        $datas = DB::table('yudisium')
            ->leftjoin('users', 'users.id', 'yudisium.users_id')
            ->select('yudisium.*', 'users.name', 'users.kode_unik')
            ->where('yudisium.id_yudisium', $id)
            ->latest('yudisium.created_at')
            ->first();
        return view('mahasiswa/yudisium.show_status', compact('datas'));
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'users_id' => 'required|numeric',
            'tanggal_surat_tugas' => 'required|date',
            'tanggal_sidang_skripsi' => 'required|date',
            'skor_tefl' => 'required|numeric',
            'sertifikat_tefl' => 'required|mimes:pdf|max:1000',
        ], [
            'users_id.required' => 'User ID wajib diisi.',
            'users_id.numeric' => 'User ID harus berupa angka.',
            'tanggal_surat_tugas.required' => 'Tanggal surat tugas wajib diisi.',
            'tanggal_surat_tugas.numeric' => 'Format tanggal sidang skripsi tidak valid.',
            'tanggal_sidang_skripsi.required' => 'Tanggal sidang skripsi wajib diisi.',
            'tanggal_sidang_skripsi.date' => 'Format tanggal sidang skripsi tidak valid.',
            'skor_tefl.required' => 'Skor TEFL wajib diisi.',
            'skor_tefl.numeric' => 'Skor TEFL harus berupa angka.',
            'sertifikat_tefl.required' => 'Sertifikat TEFL wajib diunggah.',
            'sertifikat_tefl.mimes' => 'Format file sertifikat TEFL harus berupa PDF.',
            'sertifikat_tefl.max' => 'Ukuran file sertifikat TEFL tidak boleh melebihi 1000 KB.',
        ]);

        try {
            $fileProposalName = $request->file('sertifikat_tefl')->getClientOriginalName();

            // Move the files to the appropriate directory
            $userFolder = Auth::user()->name;
            $request->file('sertifikat_tefl')->move(public_path("uploads/{$userFolder}/yudisium/"), $fileProposalName);

            // Create a new SuratTugas instance
            $yudisium = new Yudisium();
            $yudisium->users_id = $validatedData['users_id'];
            $yudisium->tanggal_surat_tugas = $validatedData['tanggal_surat_tugas'];
            $yudisium->tanggal_sidang_skripsi = $validatedData['tanggal_sidang_skripsi'];
            $yudisium->skor_tefl = $validatedData['skor_tefl'];
            $yudisium->sertifikat_tefl = "uploads/{$userFolder}/yudisium/{$fileProposalName}";
            $yudisium->status = 'pending';

            // Save to the database
            $yudisium->save();

            return redirect('/dashboard')->with('success', 'Pendaftaran Yudisium Berhasil.');
        }catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
