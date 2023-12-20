<?php

namespace App\Http\Controllers;
use App\Models\SeminarProposal as SeminarProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SeminarProposalController extends Controller
{
    public function create()
    {
        $datas = DB::table('users')
        ->join('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->join('seminar_proposal', 'seminar_proposal.users_id', 'users.id')
        ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'seminar_proposal.file_proposal', 'seminar_proposal.file_slip_pembayaran', 'seminar_proposal.status', 'seminar_proposal.tanggal')
        ->where('users.id', Auth::user()->id)
        ->where('pengajuan_judul.status', 'terima')
        ->first();
            // $datas2 = DB::table('users')
            // ->join('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
            // ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
            // ->join('seminar_proposal', 'seminar_proposal.users_id', 'users.id')
            // ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            // ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            // ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
            // ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'seminar_proposal.file_proposal', 'seminar_proposal.file_slip_pembayaran', 'seminar_proposal.status', 'seminar_proposal.tanggal', 'ruangan.nama_ruangan', 'seminar_proposal.jam', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2')
            // ->where('users.id', '=', Auth::user()->id)
            // ->where('pengajuan_judul.status', 'terima')
            // ->first();
        return view('mahasiswa/proposal/seminar_proposal.index', compact('datas'));
    }
    public function checkStatus()
    {
        $datas = DB::table('users')
        ->join('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
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
            ->select('pengajuan_judul.*', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_proposal.dosen_pembimbing_ii', 'bimbingan_proposal.acc_dosen_utama', 'bimbingan_proposal.acc_dosen_ii', 'seminar_proposal.id_seminar_proposal', 'seminar_proposal.status as seminar_status', 'bimbingan_proposal.dosen_pembimbing_utama')
            ->where('pengajuan_judul.users_id', Auth::user()->id)
            ->latest('seminar_proposal.created_at')
            ->first();

        if (is_null($proposalData) || is_null($proposalData->id_bimbingan_proposal)) {
            return view('mahasiswa/proposal/seminar_proposal.no_submission');
        } elseif($proposalData->dosen_pembimbing_ii == 'tidak ada'){
            if(is_null($proposalData->acc_dosen_utama)) {
                return view('mahasiswa/proposal/seminar_proposal.no_acc');
            }elseif (is_null($proposalData->id_seminar_proposal)) {
                return view('mahasiswa/proposal/seminar_proposal.submit_form', compact('userData', 'datas'));
            } else {
                return redirect()->route('status.show', $proposalData->id_seminar_proposal);
            }
        } elseif(is_null($proposalData->acc_dosen_utama) || is_null($proposalData->acc_dosen_ii)){
            return view('mahasiswa/proposal/seminar_proposal.no_acc');
        } elseif (is_null($proposalData->id_seminar_proposal)) {
            return view('mahasiswa/proposal/seminar_proposal.submit_form', compact('userData', 'datas'));
        } else {
            return redirect()->route('status.show', $proposalData->id_seminar_proposal);
        }
    }
    public function showStatus($id)
    {
        $datas = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            ->leftjoin('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            ->leftjoin('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
            ->select('users.*', 'pengajuan_judul.judul', 'bimbingan_proposal.*', 'seminar_proposal.file_proposal', 'seminar_proposal.file_slip_pembayaran', 'seminar_proposal.status', 'seminar_proposal.tanggal',  'seminar_proposal.jam', 'ruangan.nama_ruangan',  'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2')
            ->where('id_seminar_proposal', $id)
            ->latest('seminar_proposal.created_at')
            ->first();
        return view('mahasiswa/proposal/seminar_proposal.show_status', compact('datas'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'bimbingan_proposal_id' => 'required',
            'proposal_file' => 'required|mimes:pdf|max:5000',
            'slip_file' => 'required|mimes:pdf|max:1000',
        ], [
            'bimbingan_proposal_id.required' => 'Bimbingan Proposal ID diperlukan.',
            'proposal_file.required' => 'File proposal diperlukan.',
            'proposal_file.mimes' => 'File proposal harus berformat PDF.',
            'proposal_file.max' => 'File proposal tidak boleh lebih dari 5000 KB.',
            'slip_file.required' => 'File slip pembayaran diperlukan.',
            'slip_file.mimes' => 'File slip pembayaran harus berformat PDF.',
            'slip_file.max' => 'File slip pembayaran tidak boleh lebih dari 1000 KB.',
        ]);

        try {
            $fileProposalName = $request->file('proposal_file')->getClientOriginalName();
            // $fileProposalName = uniqid() . '.' . $request->file('proposal_file')->getClientOriginalExtension();
            $fileSlipPembayaranName = $request->file('slip_file')->getClientOriginalName();
            // $fileSlipPembayaranName = uniqid() . '.' . $request->file('slip_file')->getClientOriginalExtension();

            // Move the files to the appropriate directory
            $userFolder = Auth::user()->name;
            $request->file('proposal_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileProposalName);
            $request->file('slip_file')->move(public_path("uploads/{$userFolder}/seminar_proposal/"), $fileSlipPembayaranName);

            $seminarProposal = new SeminarProposal();
            $seminarProposal->users_id= Auth::user()->id;
            $seminarProposal->bimbingan_proposal_id = $validatedData['bimbingan_proposal_id'];
            $seminarProposal->status = 'pending';

            $seminarProposal->file_proposal = "uploads/{$userFolder}/seminar_proposal/{$fileProposalName}";
            $seminarProposal->file_slip_pembayaran = "uploads/{$userFolder}/seminar_proposal/{$fileSlipPembayaranName}";
            $seminarProposal->save();

            return redirect('/dashboard')->with('success', 'Berhasil Daftar Seminar Proposal.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
