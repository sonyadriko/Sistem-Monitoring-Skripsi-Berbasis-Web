<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BeritaAcaraSkripsi as BeritaAcaraSkripsi;
use App\Models\RevisiSidangSkripsi as RevisiSidangSkripsi;

class KoordinatorBeritaAcaraSkripsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKoordinator');
    }
    public function index()
    {
        $baskripsi = DB::table('berita_acara_skripsi')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
        ->latest('berita_acara_skripsi.created_at')
        ->get();

    return view('koordinator/berita_acara/sidang.index', compact('baskripsi'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('berita_acara_skripsi')

                ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
                ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
                ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
                ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
                ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
                ->join('users as sekretaris', 'sekretaris.id', 'sidang_skripsi.sekretaris')
                ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_berita_acara_s', $id)
                ->select('berita_acara_skripsi.*', 'users.*', 'sidang_skripsi.*', 'bidang_ilmu.*', 'ruangan.nama_ruangan', 'bimbingan_skripsi.*', 'bimbingan_proposal.*', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3', 'sekretaris.name as nama_sekretaris', 'pengajuan_judul.judul')
                ->first(),
        ];

        $bad = [
            'bad' => DB::table('detail_berita_acara_skripsi')
                    ->join('users', 'users.id', 'detail_berita_acara_skripsi.users_id')
                    ->where('berita_acara_skripsi_id', $id)
                    ->get(),
        ];


        return view('koordinator/berita_acara/sidang.detail', $data, $bad);

    }
    public function cetakrevisi(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'berita_acara_skripsi_id' => 'required|integer',
            ]);

            // Periksa apakah SeminarProposal dengan ID yang diberikan ada
            $data = BeritaAcaraSkripsi::findOrFail($id);

            // Update data SeminarProposal
            $data->cetak_revisi = 'sudah';
            $data->save();

            // Simpan data BeritaAcaraProposal
            $ba = new RevisiSidangSkripsi();
            $ba->berita_acara_skripsi_id = $request->input('berita_acara_skripsi_id');
            $ba->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

}

