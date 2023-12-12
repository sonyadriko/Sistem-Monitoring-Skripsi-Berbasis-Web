<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeminarProposal as SeminarProposal;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;

use Illuminate\Support\Facades\DB;

class KoordinatorSeminarController extends Controller
{
    public function index()
    {
        $sempros = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->whereIn('status', ['pending', 'terima'])
            ->latest('seminar_proposal.created_at')
            ->get();

        return view('koordinator/penjadwalan/seminar_proposal.index', compact('sempros'));
    }
    public function detail($id)
    {
        $data = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->where('pengajuan_judul.status', 'terima')
            ->where('id_seminar_proposal', $id)
            ->first();

            $data2 = DB::table('seminar_proposal')
            ->join('users', 'users.id', 'seminar_proposal.users_id')
            ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
            ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
            ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
            ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
            ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
            ->select(
                'seminar_proposal.*',
                'bimbingan_proposal.dosen_pembimbing_utama',
                'bimbingan_proposal.dosen_pembimbing_ii',
                'ruangan.nama_ruangan', 'users.*',
                'bidang_ilmu.topik_bidang_ilmu',
                'penguji1.name as nama_penguji_1',
                'penguji2.name as nama_penguji_2'
                )
            ->where('id_seminar_proposal', $id)
            ->first();

        // Debugging statements
        // dd($data); // Check the retrieved data

        // if (!$data) {
        //     // Log a message or use dd() to debug
        //     dd("Record not found for ID: $id");
        // }

        $baru = DB::table('users')->where('role_id', '2')->get();
        $listRuangan = DB::table('ruangan')->get();

        return view('koordinator/penjadwalan/seminar_proposal.detail', compact('data', 'data2', 'baru', 'listRuangan'));
    }



    public function updatejadwal(Request $request, $id)
    {
    $data = SeminarProposal::where('id_seminar_proposal', $id)->first();

    if (!$data) {
        return redirect()->back()->with('error', 'Data not found.');
    }

    // Update the fields
    $data->dosen_penguji_1 = $request->input('dosen_penguji_1');
    $data->dosen_penguji_2 = $request->input('dosen_penguji_2');
    $data->ruangan = $request->input('ruanganSeminar');
    $data->status = 'terima';
    $data->tanggal = $request->input('date');
    $data->jam = $request->input('time');

    // Save the updated data
    $data->save();

    return redirect()->back()->with('success', 'Data updated successfully.');
    }

    public function tolakJadwal(Request $request, $id)
    {
        $data = SeminarProposal::where('id_seminar_proposal', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Update the status to 'tolak'
        $data->status = 'tolak';

        // Save the updated data
        $data->save();

        return redirect()->route('jadwal-seminar-proposal.index')->with('success', 'Jadwal ditolak.');

    }


    public function createberitaacara(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'users_id' => 'required|integer',
                'seminar_proposal_id' => 'required|integer',
            ]);

            // Periksa apakah SeminarProposal dengan ID yang diberikan ada
            $data = SeminarProposal::findOrFail($id);

            // Update data SeminarProposal
            $data->cetak = 'sudah';
            $data->save();

            // Simpan data BeritaAcaraProposal
            $ba = new BeritaAcaraProposal();
            $ba->users_id = $request->input('users_id');
            $ba->seminar_proposal_id = $request->input('seminar_proposal_id');
            $ba->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

}
