<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SidangSkripsi as SidangSkripsi;
use Illuminate\Support\Facades\Auth;

class SidangSkripsiController extends Controller
{
    public function index()
    {
        $datas = DB::table('bimbingan_skripsi')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('users', 'users.id', 'bimbingan_proposal.user_id')
            ->join('sidang_skripsi', 'sidang_skripsi.users_id', 'users.id')
            ->select('users.*', 'bimbingan_proposal.*', 'bimbingan_skripsi.*', 'sidang_skripsi.file_skripsi', 'sidang_skripsi.file_slip_pembayaran', 'sidang_skripsi.status', 'sidang_skripsi.tanggal')
            ->where('bimbingan_proposal.user_id', Auth::user()->id)
            ->latest('sidang_skripsi.created_at')
            ->first();
        return view('mahasiswa/skripsi/sidang_skripsi.index', compact('datas'));
    }
    public function checkStatus()
    {
        $datas = DB::table('users')
        ->join('pengajuan_judul', 'pengajuan_judul.user_id', 'users.id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.user_id', 'users.id')
        ->join('bimbingan_skripsi', 'bimbingan_skripsi.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
        ->select('users.*', 'pengajuan_judul.*', 'bimbingan_proposal.*', 'bimbingan_skripsi.*')
        ->where('users.id', Auth::user()->id)
        ->where('pengajuan_judul.status', 'terima')
        ->first();

        $userData = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        $skripsiData = DB::table('pengajuan_judul')
            ->leftJoin('bimbingan_proposal', 'bimbingan_proposal.user_id', 'pengajuan_judul.user_id')
            ->leftJoin('bimbingan_skripsi', 'bimbingan_skripsi.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
            ->leftJoin('sidang_skripsi', 'sidang_skripsi.users_id', 'pengajuan_judul.user_id')
            ->select('pengajuan_judul.*', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'sidang_skripsi.status as sidang_status', 'bimbingan_proposal.dosen_pembimbing_utama')
            ->where('pengajuan_judul.user_id', Auth::user()->id)
            ->latest('sidang_skripsi.created_at')
            ->first();

        if (is_null($skripsiData) || is_null($skripsiData->id_bimbingan_skripsi)) {
            return view('mahasiswa/skripsi/sidang_skripsi.no_submission');
        } elseif (is_null($skripsiData->id_sidang_skripsi)) {
            return view('mahasiswa/skripsi/sidang_skripsi.submit_form', compact('userData', 'datas'));
        } else {
            return redirect()->route('sidang-skripsi.status', $skripsiData->id_sidang_skripsi);
        }
    }
    public function showStatus($id)
    {
        $datas = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->leftjoin('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            ->leftjoin('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            ->leftjoin('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
            ->leftjoin('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
            ->select('users.*', 'pengajuan_judul.judul', 'bimbingan_proposal.*', 'sidang_skripsi.file_skripsi', 'sidang_skripsi.file_slip_pembayaran', 'sidang_skripsi.status', 'sidang_skripsi.tanggal',  'sidang_skripsi.jam', 'ruangan.nama_ruangan',  'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3')
            ->where('id_sidang_skripsi', $id)
            ->latest('sidang_skripsi.created_at')
            ->first();
        return view('mahasiswa/skripsi/sidang_skripsi.show_status', compact('datas'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'skripsi_file' => 'required|mimes:pdf|max:10000',
            'slip_file' => 'required|mimes:pdf|max:1000',
        ], [
            'skripsi_file.required' => 'File skripsi is required.',
            'skripsi_file.mimes' => 'File skripsi must be a PDF.',
            'skripsi_file.max' => 'File skripsi may not be greater than 10000 KB.',
            'slip_file.required' => 'File slip pembayaran is required.',
            'slip_file.mimes' => 'File slip pembayaran must be a PDF.',
            'slip_file.max' => 'File slip pembayaran may not be greater than 1000 KB.',
        ]);

        // Generate unique file names
        // $fileSkripsiName = uniqid() . '.' . $request->file('skripsi_file')->getClientOriginalExtension();
        $fileSkripsiName = $request->file('skripsi_file')->getClientOriginalName();
        $fileSlipPembayaranName = $request->file('slip_file')->getClientOriginalName();
        // $fileSlipPembayaranName = uniqid() . '.' . $request->file('slip_file')->getClientOriginalExtension();

        // Move the files to the appropriate directory
        $userFolder = Auth::user()->name;
        $request->file('skripsi_file')->move(public_path("uploads/{$userFolder}/sidang_skripsi/"), $fileSkripsiName);
        $request->file('slip_file')->move(public_path("uploads/{$userFolder}/sidang_skripsi/"), $fileSlipPembayaranName);

        $SidangSkripsi = new SidangSkripsi();
        $SidangSkripsi->users_id= Auth::user()->id;
        $SidangSkripsi->bimbingan_skripsi_id = $request['id_bimbingan_skripsi'];
        $SidangSkripsi->status = 'pending';

        $SidangSkripsi->file_skripsi = "uploads/{$userFolder}/sidang_skripsi/{$fileSkripsiName}";
        $SidangSkripsi->file_slip_pembayaran = "uploads/{$userFolder}/sidang_skripsi/{$fileSlipPembayaranName}";
        $SidangSkripsi->save();

        return redirect('/dashboard')->with('success', 'Berhasil Daftar Sidang Skripsi.');

    }
}
