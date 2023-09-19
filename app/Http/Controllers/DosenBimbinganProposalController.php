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
        // return view('dosen/bimbingan/proposal.detail', compact('data'));

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
        $validatedData = $request->validate([
            'revisi' => 'required|string',
        ], [
            'revisi.required' => 'Revisi is required.',
        ]);    
    
        // Pastikan $id sesuai dengan kolom yang ingin Anda cocokkan
        $result = DB::table('detail_bimbingan_proposal')
                    ->where('id_detail_bimbingan_proposal', $id)
                    ->update([
                        'revisi' => $validatedData['revisi'],
                        'updated_at' => now(),
                    ]);
    
        if ($result) {
            return response()->json("Berhasil memperbarui revisi");
        } else {
            return response()->json("Gagal memperbarui revisi", 500); // Kode status 500 untuk Internal Server Error
        }
    }

    public function accrevisi($id, Request $request)
    {
        // $validatedData = $request->validate([
        //     'revisi' => 'required|string',
        // ], [
        //     'revisi.required' => 'Revisi is required.',
        // ]);    
    
        // Pastikan $id sesuai dengan kolom yang ingin Anda cocokkan
        $result = DB::table('detail_bimbingan_proposal')
                    ->where('id_detail_bimbingan_proposal', $id)
                    ->update([
                        'validasi' => 'acc',
                        'updated_at' => now()
                    ]);
    
        if ($result) {
            return response()->json("Berhasil acc");
        } else {
            return response()->json("Gagal acc", 500); // Kode status 500 untuk Internal Server Error
        }
    }

    public function accproposal($id, Request $request)
    {

      

        // Ambil data dari request
        // $idBimbinganProposal = $request->input('idBimbinganProposal');
        $dospem1 = $request->input('dospem1');
        $dospem2 = $request->input('dospem2');
        
        $username = Auth::user()->name;

        // return response()->json($request['dospem1']);
        
        
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
        

        // $validatedData = $request->validate([
        //     'dosen_pembimbing_utama' => 'string',
        //     'dosen_pembimbing_ii' => 'string',
        // ]);    

        // $username = Auth::user()->name;

        // if ($username === $validatedData['dosen_pembimbing_utama']) {
        //     // Pengguna adalah dosen_pembimbing_utama

        //     // Perbarui kolom yang sesuai berdasarkan peran
        //     $result_utama = DB::table('bimbingan_proposal')
        //         ->where('id_bimbingan_proposal', $id)
        //         ->update([
        //             'acc_dosen_utama' => 'acc',
        //             'tgl_acc_dosen_utama' => now()
        //         ]);

        //     // Proses hasil untuk dosen_pembimbing_utama
        //     if ($result_utama) {
        //         return response()->json('Proposal berhasil diacc untuk dosen_pembimbing_utama!');
        //     } else {
        //         return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_utama.');
        //     }
        // } elseif ($username === $validatedData['dosen_pembimbing_ii']) {
        //     $result_ii = DB::table('bimbingan_proposal')
        //         ->where('id_bimbingan_proposal', $id)
        //         ->update([
        //             'acc_dosen_ii' => 'acc',
        //             'tgl_acc_dosen_ii' => now()
        //         ]);

        //     if ($result_ii) {
        //         return response()->json('Proposal berhasil diacc untuk dosen_pembimbing_ii!');
        //     } else {
        //         return response()->json('Tidak ada peran yang sesuai ditemukan untuk dosen_pembimbing_ii.');
        //     }
        // } else {
        //     return response()->json('sumpah gangerti');

        // }


    }
}


