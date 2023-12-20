<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SuratTugas as SuratTugas;
use App\Models\BimbinganSkripsi as BimbinganSkripsi;




class KoordinatorSuratTugasController extends Controller
{
    public function index()
    {
        $surattugas = DB::table('surat_tugas')
        ->join('users', 'users.id', 'surat_tugas.users_id')
        ->join('bimbingan_proposal', 'bimbingan_proposal.users_id', 'surat_tugas.users_id')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
        ->latest('surat_tugas.created_at')
        ->get();

        return view('koordinator/surat_tugas.index', compact('surattugas'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('surat_tugas')
                ->join('users', 'users.id', 'surat_tugas.users_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'surat_tugas.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->join('seminar_proposal', 'seminar_proposal.bimbingan_proposal_id', 'bimbingan_proposal.id_bimbingan_proposal')
                ->select('surat_tugas.*', 'users.kode_unik', 'users.name', 'users.alamat_mhs', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii')
                ->where('id_surat_tugas', $id)
                ->first(),
        ];
        return view('koordinator/surat_tugas.detail', $data);
    }
    public function tolaksurat(Request $request, $id)
    {
        $data = SuratTugas::where('id_surat_tugas', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Update the status to 'tolak'
        $data->status = 'tolak';

        // Save the updated data
        $data->save();

        return redirect()->route('koor-surat-tugas.index')->with('success', 'Surat ditolak.');

    }

    public function update($id, Request $request)
    {
        try {

            $data = SuratTugas::findOrFail($id);

            // Peroleh nomor surat terakhir
            $lastNumber = SuratTugas::max('nomor_surat_tugas');
            $lastNumber = (int)substr($lastNumber, strlen('ITATS/FORM/SPM/'));

            // Konstruksi nomor surat baru
            $prefix = 'ITATS/FORM/SPM/';
            $nextNumber = $lastNumber + 1;
            $nomorSuratLengkap = $prefix . (string)$nextNumber;

            // Set nilai nomor surat dan tanggal pada data yang akan disimpan
            $data->nomor_surat_tugas = $nomorSuratLengkap;
            $data->tanggal_terbit = Carbon::now();
            $data->tanggal_kadaluwarsa = Carbon::now()->addMonths(6);
            $data->status = 'terima';

            // Simpan data ke database
            $data->save();

            $bimsk = new BimbinganSkripsi();
            $bimsk->bimbingan_proposal_id = $request['bimproid'];
            $bimsk->users_id = $request['users_id'];

            $bimsk->save();

            return redirect()->route('koor-surat-tugas.index')->with('success', 'Surat Tugas Berhasil dicetak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Surat Tugas Gagal dicetak.');
        }
    }
}
