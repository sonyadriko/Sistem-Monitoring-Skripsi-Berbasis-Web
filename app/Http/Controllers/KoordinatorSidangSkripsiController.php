<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidangSkripsi as SidangSkripsi;
use App\Models\BeritaAcaraSkripsi as BeritaAcaraSkripsi;
use Illuminate\Support\Facades\DB;

class KoordinatorSidangSkripsiController extends Controller
{
    public function index()
    {
        $semhas = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            ->whereIn('status', ['pending', 'terima'])
            ->latest('sidang_skripsi.created_at')
            ->get();
        return view('koordinator/penjadwalan/sidang_skripsi.index', compact('semhas'));
    }
    public function detail($id)
    {
        $data = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            // ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            // ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
            // ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
            // ->join('users as sekre', 'sekre.id', 'sidang_skripsi.sekretaris')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            // ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            // ->select('sidang_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii', 'ruangan.nama_ruangan', 'users.*', 'bimbingan_skripsi.*', 'bidang_ilmu.topik_bidang_ilmu', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3', 'sekre.name as nama_sekretaris')
            ->where('id_sidang_skripsi',  $id)
            ->where('pengajuan_judul.status', 'terima')
            ->first();
        $data2 = DB::table('sidang_skripsi')
            ->join('users', 'users.id', 'sidang_skripsi.users_id')
            ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
            ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
            ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
            ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('ruangan', 'ruangan.id_ruangan', 'sidang_skripsi.ruangan')
            ->select('sidang_skripsi.*', 'bimbingan_proposal.dosen_pembimbing_utama', 'bimbingan_proposal.dosen_pembimbing_ii', 'ruangan.nama_ruangan', 'users.*', 'bimbingan_skripsi.*', 'bidang_ilmu.topik_bidang_ilmu', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3')
            ->where('id_sidang_skripsi', '=', $id)
            ->first();


        $baru = DB::table('users')->where('role_id', '2')->get();
        $listRuangan = DB::table('ruangan')->get();

        return view('koordinator/penjadwalan/sidang_skripsi.detail', compact('data', 'baru', 'listRuangan', 'data2'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'dosenPenguji1' => 'required',
            'dosenPenguji2' => 'required',
            'dosenPenguji3' => 'required',
            'ruanganSeminar' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Temukan data sidang skripsi berdasarkan ID
        $sidangSkripsi = SidangSkripsi::find($id);

        if ($sidangSkripsi) {
            // Update data sidang skripsi
            $sidangSkripsi->update([
                'dosen_penguji_1' => $request->input('dosenPenguji1'),
                'dosen_penguji_2' => $request->input('dosenPenguji2'),
                'dosen_penguji_3' => $request->input('dosenPenguji3'),
                'ruangan' => $request->input('ruanganSeminar'),
                'tanggal' => $request->input('date'),
                'jam' => $request->input('time'),
                'status' => 'terima',
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('jadwal-sidang-skripsi.index')->with('success', 'Jadwal Sidang Skripsi berhasil diperbarui.');
        } else {
            // Redirect dengan pesan error jika data sidang skripsi tidak ditemukan
            return redirect()->route('jadwal-sidang-skripsi.index')->with('error', 'Jadwal Sidang Skripsi tidak ditemukan.');
        }
    }
    public function createberitaacara(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'user_id' => 'required|integer',
                'sidang_skripsi_id' => 'required|integer',
            ]);

            // Periksa apakah SidangSkripsi dengan ID yang diberikan ada
            $data = SidangSkripsi::findOrFail($id);

            // Update data SidangSkripsi
            $data->cetak = 'sudah';
            $data->save();

            // Simpan data BeritaAcaraSkripsi
            $ba = new BeritaAcaraSkripsi();
            $ba->users_id = $request->input('user_id');
            $ba->sidang_skripsi_id = $request->input('sidang_skripsi_id');
            $ba->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
    public function tolakJadwal(Request $request, $id)
    {
        $data = SidangSkripsi::where('id_sidang_skripsi', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Update the status to 'tolak'
        $data->status = 'tolak';

        // Save the updated data
        $data->save();

        return redirect()->route('jadwal-sidang-skripsi.index')->with('success', 'Jadwal ditolak.');

    }

}
