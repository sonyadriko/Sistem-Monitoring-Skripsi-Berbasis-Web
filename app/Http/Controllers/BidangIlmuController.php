<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\BidangIlmu as BidangIlmu;
use App\Models\DetailBidangIlmu as DetailBidangIlmu;
use App\Models\PaperBidangIlmu as PaperBidangIlmu;
use App\Models\MataKuliahPendukung as MataKuliahPendukung;


class BidangIlmuController extends Controller
{
    public function index()
    {
        $bi = DB::table('bidang_ilmu')
            ->join('users', 'users.id', 'bidang_ilmu.users_id')
            ->get();

        return view('koordinator/bidang_ilmu.index', compact('bi'));
    }

    public function create()
    {
        $users = DB::table('users')->where('role_id', '2')->get();
        $mkp = DB::table('mata_kuliah_pendukung')->get();
        return view('koordinator/bidang_ilmu.create', compact('users', 'mkp'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'topik_bidang_ilmu' => 'required|string',
            'selected_mkp.*' => 'required|string',
            'dosen_pengampu.*' => 'required|string', // You can remove this line if it's not part of the form
            'keterangan' => 'required|string',
        ], [
            'topik_bidang_ilmu.required' => 'Topik bidang ilmu is required.',
            'selected_mkp.*.exists' => 'Invalid Matakuliah Pendukung selected.',
            'selected_users.*.exists' => 'Invalid User selected.',
            'keterangan.required' => 'Keterangan is required.',
        ]);
        $selectedUsers = $request->input('selected_users') ?? [];

        // Cek apakah bidang ilmu sudah ada
        $existingBidangIlmu = BidangIlmu::where('topik_bidang_ilmu', $validatedData['topik_bidang_ilmu'])->first();

        if (!$existingBidangIlmu) {
            // Jika bidang ilmu belum ada, buat baru
            $form = new BidangIlmu();
            $form->users_id = Auth::user()->id;
            $form->topik_bidang_ilmu = $validatedData['topik_bidang_ilmu'];
            $form->mata_kuliah_pendukung = implode(',', $validatedData['selected_mkp']);
            $form->status = 'tersedia';
            $form->keterangan = $validatedData['keterangan'];

            $form->save();
        } else {
            // Jika bidang ilmu sudah ada, gunakan bidang ilmu yang sudah ada
            $form = $existingBidangIlmu;
        }

        // Simpan detail bidang ilmu sesuai checkbox yang dipilih
        foreach ($selectedUsers as $userId) {
            $detailBidangIlmu = new DetailBidangIlmu();
            $detailBidangIlmu->bidang_ilmu_id = $form->id_bidang_ilmu; // Pastikan bidang ilmu sudah memiliki ID yang valid
            $detailBidangIlmu->users_id = $userId;
            $detailBidangIlmu->save();
        }


        // Redirect to the dashboard or any other appropriate route
        return redirect('/koordinator/bidang_ilmu');
    }

    public function detail($id, Request $request)
    {
        $bidetail = DB::table('bidang_ilmu')
                    ->join('mata_kuliah_pendukung', 'mata_kuliah_pendukung.id_mata_kuliah_pendukung', 'bidang_ilmu.mata_kuliah_pendukung')
                    ->where('id_bidang_ilmu', $id)->first();
        $paper = DB::table('paper_bidang_ilmu')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'paper_bidang_ilmu.bidang_ilmu_id')
                    ->where('id_bidang_ilmu', $id)->get();
        return view('koordinator/bidang_ilmu.detail', compact('bidetail', 'paper'));
    }
//     public function detail($id, Request $request)
// {
//     $bidetail = BidangIlmu::with('mataKuliahPendukung')->find($id);
//     $paper = DB::table('paper_bidang_ilmu')
//         ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'paper_bidang_ilmu.bidang_ilmu_id')
//         ->where('id_bidang_ilmu', $id)
//         ->get();

//     return view('koordinator/bidang_ilmu.detail', compact('bidetail', 'paper'));
// }


// public function mataKuliahPendukung()
// {
//     return $this->belongsTo(MataKuliahPendukung::class, 'mata_kuliah_pendukung');
// }


}
