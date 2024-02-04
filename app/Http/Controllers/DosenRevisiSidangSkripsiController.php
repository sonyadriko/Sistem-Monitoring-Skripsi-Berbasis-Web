<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailBeritaAcaraSkripsi as DetailBeritaAcaraSkripsi;
use App\Models\DetailRevisiSidangSkripsi as DetailRevisiSidangSkripsi;
use Illuminate\Support\Carbon;

class DosenRevisiSidangSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {
        $rev = DB::table('revisi_sidang_skripsi')
        ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
        ->where(function($query) {
            $query->where('sidang_skripsi.dosen_penguji_1', '=', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_2', '=', Auth::user()->id)
                  ->orWhere('sidang_skripsi.dosen_penguji_3', '=', Auth::user()->id)
                  ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', '=', Auth::user()->name);

        })
        ->latest('revisi_sidang_skripsi.created_at')
        ->get();

        $angkatan = DB::table('angkatan')->get();

        return view('dosen/revisi/skripsi.index', compact('rev', 'angkatan'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('revisi_sidang_skripsi')
                    ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'revisi_sidang_skripsi.berita_acara_skripsi_id')
                    ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
                    ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
                    ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
                    ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
                    ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
                    // ->join('users as sekretaris', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
                    ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                    ->select('revisi_sidang_skripsi.*', 'berita_acara_skripsi.*', 'users.*', 'sidang_skripsi.*', 'bidang_ilmu.*', 'bimbingan_proposal.*','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3', 'pengajuan_judul.judul')
                    // ->select('bimbingan_proposal.*', 'users.*', 'bidang_ilmu.topik_bidang_ilmu')
                    ->where('id_revisi_sidang_skripsi', $id)
                    ->first(),
            'detail' => DB::table('detail_revisi_sidang_skripsi')
                    ->join('revisi_sidang_skripsi', 'revisi_sidang_skripsi.id_revisi_sidang_skripsi', 'detail_revisi_sidang_skripsi.revisi_sidang_skripsi_id')
                    ->select('detail_revisi_sidang_skripsi.*')
                    ->where('id_revisi_sidang_skripsi', $id)
                    ->get(),
            'revisi' => DB::table('detail_berita_acara_skripsi')
                    ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
                    ->where('detail_berita_acara_skripsi.users_id', Auth::User()->id)
                    ->first(),
        ];

        return view('dosen/revisi/skripsi.detail', ['data' => $data['data'], 'detail' => $data['detail'], 'revisi' => $data['revisi']]);
        // return view('dosen/revisi/proposal.detail', ['data' => $data['data']]);


    }

    public function tambahrevisi(Request $request)
    {
        $validatedData = $request->validate([
            'revisiInput' => 'required|string',
        ], [
            'revisiInput.required' => 'Revisi is required.',
        ]);

        $detailRevisiSidangSkripsi = new DetailRevisiSidangSkripsi();
        $detailRevisiSidangSkripsi->users_id = Auth::user()->id;
        $detailRevisiSidangSkripsi->revisi_sidang_skripsi_id = $request->input('idRevisiBimbinganSkripsi');
        $detailRevisiSidangSkripsi->revisi = $validatedData['revisiInput'];
        $detailRevisiSidangSkripsi->updated_at = now();
        $detailRevisiSidangSkripsi->save();

        return response()->json("Berhasil menambah revisi");
    }

    public function accrevisi($id, Request $request)
    {

        $dospem = $request->input('dospem');
        $penguji1 = $request->input('penguji1');
        $penguji2 = $request->input('penguji2');
        $penguji3 = $request->input('penguji3');

        $username = Auth::user()->name;

        if ($username === $dospem) {
            $result_utama = DB::table('berita_acara_skripsi')
                ->where('id_berita_acara_s', $id)
                ->update([
                    'acc_dospem' => 'acc',
                    'tgl_acc_dospem' => now(),
                    'updated_at' => now()
                ]);

            if ($result_utama) {
                return response()->json('Revisi Skripsi berhasil diacc oleh dosen pembimbing utama!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_utama.');
            }
        } elseif ($username === $penguji1) {
            $result_ii = DB::table('berita_acara_skripsi')
                ->where('id_berita_acara_s', $id)
                ->update([
                    'acc_penguji_1' => 'acc',
                    'tgl_acc_penguji_1' => now(),
                    'updated_at' => now()
                ]);

            if ($result_ii) {
                return response()->json('Revisi Skripsi berhasil diacc oleh dosen penguji 1!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen penguji 1.');
            }
        } elseif ($username === $penguji2) { // Corrected condition for penguji2
            $result_penguji2 = DB::table('berita_acara_skripsi')
                ->where('id_berita_acara_s', $id)
                ->update([
                    'acc_penguji_2' => 'acc',
                    'tgl_acc_penguji_2' => now(),
                    'updated_at' => now()
                ]);

            if ($result_penguji2) {
                return response()->json('Revisi Skripsi berhasil diacc untuk dosen penguji 2!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen penguji 2.');
            }
        } elseif ($username === $penguji3) { // Corrected condition for penguji2
            $result_penguji3 = DB::table('berita_acara_skripsi')
                ->where('id_berita_acara_s', $id)
                ->update([
                    'acc_penguji_3' => 'acc',
                    'tgl_acc_penguji_3' => now(),
                    'updated_at' => now()
                ]);

            if ($result_penguji3) {
                return response()->json('Revisi Skripsi berhasil diacc untuk dosen penguji 3!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen penguji 3.');
            }
        }else {
            return response()->json('Sumpah gangerti');
        }
    }
    public function addrevisi(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'revisi' => 'required|string',
        ]);

        // Find the record in the database
        $detail = DetailBeritaAcaraSkripsi::find($id);

        // If the record doesn't exist, you may want to handle this scenario based on your requirements
        if (!$detail) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Update the revisi column
        $detail->revisi = $request->revisi;
        $detail->updated_at = Carbon::now();
        $detail->save();

        return response()->json(['message' => 'Revisi berhasil disimpan.']);
    }

}
