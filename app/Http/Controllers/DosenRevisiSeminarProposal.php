<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DetailBeritaAcaraProposal as DetailBeritaAcaraProposal;
use App\Models\DetailRevisiSeminarProposal as DetailRevisiSeminarProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DosenRevisiSeminarProposal extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {
        $rev = DB::table('berita_acara_proposal')
            ->join('users', 'users.id', 'berita_acara_proposal.users_id')
            ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->select('users.name', 'users.kode_unik', 'pengajuan_judul.judul', 'bidang_ilmu.topik_bidang_ilmu', 'bimbingan_proposal.dosen_pembimbing_utama', 'seminar_proposal.dosen_penguji_1', 'seminar_proposal.dosen_penguji_2', 'revisi_seminar_proposal.id_revisi_seminar_proposal')
            ->where(function($query) {
                $query->where('seminar_proposal.dosen_penguji_1', Auth::user()->id)
                      ->orWhere('seminar_proposal.dosen_penguji_2', Auth::user()->id)
                      ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', Auth::user()->name);
            })
            ->latest('berita_acara_proposal.created_at')
            ->get();

        $angkatan = DB::table('angkatan')->get();

        return view('dosen/revisi/proposal.index', compact('rev', 'angkatan'));

    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('revisi_seminar_proposal')
                    ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'revisi_seminar_proposal.berita_acara_proposal_id')
                    ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                    ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
                    ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
                    ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                    ->join('detail_berita_acara_proposal', 'detail_berita_acara_proposal.berita_acara_proposal_id', 'berita_acara_proposal.id_berita_acara_p')
                    ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->where('id_revisi_seminar_proposal', $id)
                    ->select('revisi_seminar_proposal.*', 'berita_acara_proposal.*', 'users.*', 'seminar_proposal.*', 'bidang_ilmu.*', 'bimbingan_proposal.*','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'pengajuan_judul.judul')
                    ->first(),
            'detail' => DB::table('detail_revisi_seminar_proposal')
                    ->join('revisi_seminar_proposal', 'revisi_seminar_proposal.id_revisi_seminar_proposal', 'detail_revisi_seminar_proposal.revisi_seminar_proposal_id')
                    ->where('detail_revisi_seminar_proposal.users_id', Auth::user()->id)
                    ->where('revisi_seminar_proposal_id', $id)
                    ->get(),
            'revisi' => DB::table('detail_berita_acara_proposal')
                ->join('berita_acara_proposal', 'berita_acara_proposal.id_berita_acara_p', 'detail_berita_acara_proposal.berita_acara_proposal_id')
                ->where('detail_berita_acara_proposal.users_id', Auth::User()->id)
                ->first(),
        ];
        return view('dosen/revisi/proposal.detail', ['data' => $data['data'], 'detail' => $data['detail'], 'revisi' => $data['revisi']]);
    }

    public function tambahrevisi(Request $request)
    {
        $validatedData = $request->validate([
            'revisiInput' => 'required|string',
        ], [
            'revisiInput.required' => 'Revisi is required.',
        ]);

        $detailRevisiSeminarProposal = new DetailRevisiSeminarProposal();
        $detailRevisiSeminarProposal->users_id = Auth::user()->id;
        $detailRevisiSeminarProposal->revisi_seminar_proposal_id = $request->input('idRevisiBimbinganProposal');
        $detailRevisiSeminarProposal->revisi = $validatedData['revisiInput'];
        $detailRevisiSeminarProposal->updated_at = now();
        $detailRevisiSeminarProposal->save();

        return response()->json("Berhasil menambah revisi");
    }

    public function accrevisi($id, Request $request)
    {

        $dospem = $request->input('dospem');
        $penguji1 = $request->input('penguji1');
        $penguji2 = $request->input('penguji2'); // Corrected variable name

        $username = Auth::user()->name;

        if ($username === $dospem) {
            $result_utama = DB::table('berita_acara_proposal')
                ->where('id_berita_acara_p', $id)
                ->update([
                    'acc_dospem' => 'acc',
                    'tgl_acc_dospem' => now(),
                    'updated_at' => now()
                ]);

            if ($result_utama) {
                return response()->json('Proposal berhasil diacc oleh dosen pembimbing utama!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_utama.');
            }
        } elseif ($username === $penguji1) {
            $result_ii = DB::table('berita_acara_proposal')
                ->where('id_berita_acara_p', $id)
                ->update([
                    'acc_penguji_1' => 'acc',
                    'tgl_acc_penguji_1' => now(),
                    'updated_at' => now()
                ]);

            if ($result_ii) {
                return response()->json('Proposal berhasil diacc oleh dosen penguji 1!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen penguji 1.');
            }
        } elseif ($username === $penguji2) { // Corrected condition for penguji2
            $result_penguji2 = DB::table('berita_acara_proposal')
                ->where('id_berita_acara_p', $id)
                ->update([
                    'acc_penguji_2' => 'acc',
                    'tgl_acc_penguji_2' => now(),
                    'updated_at' => now()
                ]);

            if ($result_penguji2) {
                return response()->json('Proposal berhasil diacc untuk dosen penguji 2!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen penguji 2.');
            }
        } else {
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
        $detail = DetailBeritaAcaraProposal::find($id);

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
