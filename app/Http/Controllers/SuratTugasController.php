<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SuratTugas as SuratTugas;


class SuratTugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkMahasiswa');
    }
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
        if (!$datas) {
            // Handle the case where data is not found
            return view('mahasiswa/proposal/surat_tugas.index')->with('datas', null);
        }
        return view('mahasiswa/proposal/surat_tugas.index', compact('datas'));
    }

    public function checkStatus()
    {
        $datas = DB::table('users')
        ->join('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->join('seminar_proposal', 'seminar_proposal.users_id', 'users.id')
        ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'seminar_proposal.tanggal')
        ->where('users.id', Auth::user()->id)
        ->where('pengajuan_judul.status', 'terima')
        ->first();

        $userData = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        $proposalData = DB::table('pengajuan_judul')
            ->leftJoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'pengajuan_judul.users_id')
            ->leftJoin('seminar_proposal', 'seminar_proposal.users_id', 'pengajuan_judul.users_id')
            ->leftjoin('surat_tugas', 'surat_tugas.users_id', 'pengajuan_judul.users_id')
            ->leftjoin('users', 'users.id', 'pengajuan_judul.users_id')
            ->select('pengajuan_judul.*', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.id_seminar_proposal', 'surat_tugas.id_surat_tugas', 'surat_tugas.status as st_status', 'seminar_proposal.status as seminar_status', 'bimbingan_proposal.dosen_pembimbing_utama', 'users.alamat_mhs')
            ->where('pengajuan_judul.users_id', Auth::user()->id)
            ->latest('seminar_proposal.created_at')
            ->first();
        if (is_null($proposalData) || is_null($proposalData->id_seminar_proposal)) {
            return view('mahasiswa/proposal/surat_tugas.no_submission');
        } elseif (is_null($proposalData->alamat_mhs)) {
            return view('mahasiswa/proposal/surat_tugas.no_profile');
        } elseif (is_null($proposalData->id_surat_tugas)) {
            return view('mahasiswa/proposal/surat_tugas.submit_form', compact('userData', 'datas'));
        } else {
            return redirect()->route('pengajuan-st.show', $proposalData->id_surat_tugas);
        }
    }

    public function showStatus($id)
    {
        $datas = DB::table('surat_tugas')
            ->join('users', 'users.id', 'surat_tugas.users_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'surat_tugas.users_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->select('users.*', 'pengajuan_judul.judul', 'bimbingan_proposal.*', 'surat_tugas.file_proposal', 'surat_tugas.file_slip_pembayaran', 'surat_tugas.status', 'surat_tugas.tanggal_terbit',  'surat_tugas.tanggal_kadaluwarsa', 'surat_tugas.nomor_surat_tugas')
            ->where('id_surat_tugas', $id)
            ->latest('surat_tugas.created_at')
            ->first();
        return view('mahasiswa/proposal/surat_tugas.show_status', compact('datas'));
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'users_id' => 'required|numeric',
            'bimbingan_proposal_id' => 'required|numeric',
            'tanggal_sidang_proposal' => 'required|date',
            'file_proposal' => 'required|mimes:pdf|max:5000',
            'file_slip_pembayaran' => 'required|mimes:pdf|max:1000',
        ], [
            'users_id.required' => 'User ID wajib diisi.',
            'bimbingan_proposal_id.required' => 'ID Bimbingan Proposal wajib diisi.',
            'file_proposal.required' => 'File proposal wajib diunggah.',
            'file_proposal.mimes' => 'File proposal harus berupa PDF.',
            'file_proposal.max' => 'Ukuran file proposal tidak boleh lebih dari 5 MB.',
            'file_slip_pembayaran.required' => 'File slip pembayaran wajib diunggah.',
            'file_slip_pembayaran.mimes' => 'File slip pembayaran harus berupa PDF.',
            'file_slip_pembayaran.max' => 'Ukuran file slip pembayaran tidak boleh lebih dari 1 MB.',
        ]);

        try {
            $fileProposalName = $request->file('file_proposal')->getClientOriginalName();
            $fileSlipPembayaranName = $request->file('file_slip_pembayaran')->getClientOriginalName();

            // Move the files to the appropriate directory
            $userFolder = Auth::user()->name;
            $request->file('file_proposal')->move(public_path("uploads/{$userFolder}/surat_tugas/"), $fileProposalName);
            $request->file('file_slip_pembayaran')->move(public_path("uploads/{$userFolder}/surat_tugas/"), $fileSlipPembayaranName);

            // Create a new SuratTugas instance
            $suratTugas = new SuratTugas();
            $suratTugas->users_id = $validatedData['users_id'];
            $suratTugas->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];
            $suratTugas->tanggal_sidang_proposal = $validatedData['tanggal_sidang_proposal'];
            $suratTugas->file_proposal = "uploads/{$userFolder}/surat_tugas/{$fileProposalName}";
            $suratTugas->file_slip_pembayaran = "uploads/{$userFolder}/surat_tugas/{$fileSlipPembayaranName}";
            $suratTugas->status = 'pending';

            // Save to the database
            $suratTugas->save();

            return redirect('/dashboard')->with('success', 'Pengajuan Surat Tugas Berhasil.');
        }catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
}