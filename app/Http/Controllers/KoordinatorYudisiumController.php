<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Yudisium as Yudisium;


class KoordinatorYudisiumController extends Controller
{
    public function index()
    {
        $yudisium = DB::table('yudisium')
        ->join('users', 'users.id', 'yudisium.users_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->latest('yudisium.created_at')
        ->get();

        return view('koordinator/yudisium.index', compact('yudisium'));
    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('yudisium')
                ->join('users', 'users.id', 'yudisium.users_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->select('yudisium.*', 'users.kode_unik', 'users.name', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii')
                ->where('id_yudisium', $id)
                ->first(),
        ];
        return view('koordinator/yudisium.detail', $data);
    }
    public function update($id, Request $request)
    {
        try {

            $data = Yudisium::findOrFail($id);

            // Konstruksi nomor surat baru

            // Set nilai nomor surat dan tanggal pada data yang akan disimpan
            $data->status = $request->input('status');

            // Simpan data ke database
            $data->save();


            return redirect()->route('koor-yudisium.index')->with('success', 'Yudisium berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Yudisium Gagal diupdate.');
        }
    }
}
