<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BidangIlmu as BidangIlmu;


class BidangIlmuController extends Controller
{
    public function index()
    {
        $bi = DB::table('bidang_ilmu')
            ->join('users', 'users.id', 'bidang_ilmu.user_id')
            ->where('user_id', '=', Auth::user()->id)->get();

        return view('dosen/bidang_ilmu.index', compact('bi'));
    }

    public function create()
    {
        return view('dosen/bidang_ilmu.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'topik_bidang_ilmu' => 'required|string',
            'mata_kuliah_pendukung' => 'required|string',
            'keterangan' => 'required|string',
        ], [
            'topik_bidang_ilmu.required' => 'topik bidang ilmu is required.',
            'mata_kuliah_pendukung.required' => 'mata kuliah pendukung is required.',
            'keterangan.required' => 'keterangan is required.',
        ]);
        
        $form = new BidangIlmu();
        $form->user_id = Auth::user()->id;
        $form->topik_bidang_ilmu = $validatedData['topik_bidang_ilmu'];
        $form->mata_kuliah_pendukung = $validatedData['mata_kuliah_pendukung'];
        $form->keterangan = $validatedData['keterangan'];

        $form->save();

        return redirect('/dashboard');
    }
}
