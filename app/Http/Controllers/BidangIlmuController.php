<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidangIlmu as BidangIlmu;


class BidangIlmuController extends Controller
{
    public function index()
    {
        return view('dosen/bidang_ilmu.index');
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
        $form->topik_bidang_ilmu = $validatedData['topik_bidang_ilmu'];
        $form->mata_kuliah_pendukung = $validatedData['mata_kuliah_pendukung'];
        $form->keterangan = $validatedData['keterangan'];

        $form->save();

        return redirect('/dashboard');
    }
}
