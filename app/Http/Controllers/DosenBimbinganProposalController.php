<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BimbinganProposal as BimbinganProposal;
use App\Models\DetailBimbinganProposal as DetailBimbinganProposal;
use Illuminate\Support\Facades\DB;

class DosenBimbinganProposalController extends Controller
{

    public function index()
    {
        $bimbinganp = DB::table('bimbingan_proposal')
                ->join('tema', 'tema.id_tema', 'bimbingan_proposal.tema_id')
                ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where(function($query) {
                    $query->where('dosen_pembimbing_utama', Auth::user()->name)
                          ->orWhere('dosen_pembimbing_ii', Auth::user()->name);
                })
                ->orderBy('bimbingan_proposal.created_at', 'desc')
                ->get();
        return view('dosen/bimbingan/proposal.index', compact('bimbinganp'));


    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('bimbingan_proposal')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->join('users', 'users.id', 'bimbingan_proposal.user_id')
                    ->select('bimbingan_proposal.*', 'users.*', 'bidang_ilmu.topik_bidang_ilmu')
                    ->where('id_bimbingan_proposal', '=',$id)->first(),
            'detail' => DB::table('detail_bimbingan_proposal')->where('bimbingan_proposal_id', '=',$id)->get(),
        ];

        return view('dosen/bimbingan/proposal.detail', ['data' => $data['data'], 'detail' => $data['detail']]);

    }

    public function addrevisi($id)
    {
        $data = [
            'data' =>DB::table('bimbingan_proposal')->where('id_bimbingan_proposal', $id)->first(),
        ];

        return view('dosen/bimbingan/proposal.detail', ['data' => $data['data']]);
    }


    public function updaterevisi($id, Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'revisi' => 'required|string',
        ], [
            'revisi.required' => 'Revisi is required.',
        ]);

        try {
            // Temukan detail bimbingan proposal berdasarkan ID
            $detailBimbingan = DetailBimbinganProposal::findOrFail($id);

            // Update revisi
            $detailBimbingan->revisi = $validatedData['revisi'];
            $detailBimbingan->updated_at = now();
            $detailBimbingan->save();

            return response()->json("Berhasil memperbarui revisi");
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json("Gagal memperbarui revisi: " . $e->getMessage(), 500); // Kode status 500 untuk Internal Server Error
        }
    }

    public function accrevisi($id, Request $request)
    {
        try {
            // Temukan detail bimbingan proposal berdasarkan ID
            $detailBimbingan = DetailBimbinganProposal::findOrFail($id);

            // Update validasi menjadi 'acc'
            $detailBimbingan->validasi = 'acc';
            $detailBimbingan->updated_at = now();
            $detailBimbingan->save();

            return response()->json("Berhasil acc");
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error validasi
            $errors = $e->errors();
            return response()->json(['error' => 'Gagal acc', 'validation_errors' => $errors], 422);
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return response()->json(['error' => 'Gagal acc: ' . $e->getMessage()], 500);
        }

    }

    public function accproposal($id, Request $request)
    {

        $dospem1 = $request->input('dospem1');
        $dospem2 = $request->input('dospem2');

        $username = Auth::user()->name;
        if ($username === $dospem1) {
            $result_utama = DB::table('bimbingan_proposal')
                ->where('id_bimbingan_proposal', $id)
                ->update([
                    'acc_dosen_utama' => 'acc',
                    'tgl_acc_dosen_utama' => now()
                ]);

            if ($result_utama) {
                return response()->json('Proposal berhasil diacc untuk dosen_pembimbing_utama!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_utama.');
            }
        } elseif ($username === $dospem2) {
            $result_ii = DB::table('bimbingan_proposal')
                ->where('id_bimbingan_proposal', $id)
                ->update([
                    'acc_dosen_ii' => 'acc',
                    'tgl_acc_dosen_ii' => now()
                ]);

            if ($result_ii) {
                return response()->json('Proposal berhasil diacc untuk dosen_pembimbing_ii!');
            } else {
                return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_ii.');
            }
        } else {
            return response()->json('sumpah gangerti');
        }
    }
}


