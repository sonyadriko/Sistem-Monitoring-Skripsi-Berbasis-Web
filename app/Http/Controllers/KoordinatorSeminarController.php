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
        // $sempros = SeminarProposal::all();
        $sempros = DB::table('seminar_proposal')->join('users', 'users.id', 'seminar_proposal.users_id')->get();

        return view('koordinator/penjadwalan/seminar_proposal.index', compact('sempros'));

    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('seminar_proposal')
                ->join('users', 'users.id', 'seminar_proposal.users_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_seminar_proposal', '=', $id)->first(),
        ];
        // dd($data);

        $baru = [
            'baru' => DB::table('users')->where('role_id', '2')->get(),
        ];
        return view('koordinator/penjadwalan/seminar_proposal.detail', $data, $baru);


        // if ($data['data']) {
        //     $userId = $data['data']->user_id;
        //     $temaId = $data['data']->tema_id;

        //     $users = DB::table('users')->where('id', '=', $userId)->first();
        //     $tema = DB::table('tema')->where('id_tema', '=', $temaId)->first();

        //     if ($users) {
        //         $data['users'] = $users;
        //         $data['tema'] = $tema;

        //         return view('koordinator/penjadwalan/seminar_proposal.detail', $data);
        //     } else {
        //         // Handle the case when no user record was found
        //         return redirect()->back()->with('error', 'User not found.');
        //     }
        // } else {
        //     // Handle the case when no seminar proposal record was found
        //     return redirect()->back()->with('error', 'Seminar proposal record not found.');
        // }
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
    $data->ruangan = $request->input('ruangan_seminar');
    $data->tanggal = $request->input('date');
    $data->jam = $request->input('time');

    // Save the updated data
    $data->save();

    return redirect()->back()->with('success', 'Data updated successfully.');
    }

    public function createberitaacara(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'user_id' => 'required|integer',
                'seminar_proposal_id' => 'required|integer',
            ]);

            // Periksa apakah SeminarProposal dengan ID yang diberikan ada
            $data = SeminarProposal::findOrFail($id);

            // Update data SeminarProposal
            $data->cetak = 'sudah';
            $data->save();

            // Simpan data BeritaAcaraProposal
            $ba = new BeritaAcaraProposal();
            $ba->users_id = $request->input('user_id');
            $ba->seminar_proposal_id = $request->input('seminar_proposal_id');
            $ba->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

}
