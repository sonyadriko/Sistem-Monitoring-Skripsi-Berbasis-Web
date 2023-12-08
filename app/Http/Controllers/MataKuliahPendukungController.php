<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliahPendukung as MataKuliahPendukung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MataKuliahPendukungController extends Controller
{
    //
    public function index()
    {
        $mk = DB::table('mata_kuliah_pendukung')->get();

        return view('koordinator/mata_kuliah_pendukung.index', compact('mk'));
    }
    public function create()
    {
        return view('koordinator/mata_kuliah_pendukung.create');
    }
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'nama_mata_kuliah' => 'required|string',
        ], [
            'nama_mata_kuliah.required' => 'Nama Mata Kuliah is required.',
        ]);

        $form = new MataKuliahPendukung();
        $form->nama_mata_kuliah = $validatedData['nama_mata_kuliah'];
        $form->save();
        $message = 'Mata kuliah berhasil ditambahkan!';

        // return redirect('/koordinator/mata_kuliah_pendukung')->with('success', $message);
        return redirect('/koordinator/mata_kuliah_pendukung');

    }
}
