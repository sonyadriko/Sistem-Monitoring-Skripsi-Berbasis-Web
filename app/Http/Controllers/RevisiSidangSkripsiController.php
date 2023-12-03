<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RevisiSidangSkripsi as RevisiSidangSkripsi;

class RevisiSidangSkripsiController extends Controller
{
    public function index()
    {

        $revisisk = DB::table('detail_berita_acara_skripsi')
        ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.id_berita_acara_s', 'users.*')
        ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
        ->join('users', 'users.id', '=', 'detail_berita_acara_skripsi.users_id')
        ->where('berita_acara_skripsi.users_id', Auth::user()->id)
        ->first();

        $revisisk2 = DB::table('detail_berita_acara_skripsi')
    ->select('detail_berita_acara_skripsi.*', 'berita_acara_skripsi.id_berita_acara_s', 'users.*')
    ->join('berita_acara_skripsi', 'berita_acara_skripsi.id_berita_acara_s', 'detail_berita_acara_skripsi.berita_acara_skripsi_id')
    ->join('users', 'users.id', '=', 'detail_berita_acara_skripsi.users_id')
    ->where('berita_acara_skripsi.users_id', Auth::user()->id)
    ->get();

        return view('mahasiswa/skripsi/revisi.index', compact('revisisk', 'revisisk2')) ;

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_revisi_skripsi' => 'required|mimes:pdf,docx|max:1000',
            'file_revisi_skripsi.required' => 'File Skripsi wajib diunggah.',
            'file_revisi_skripsi.mimes' => 'Tipe file harus pdf atau docx.',
            'file_revisi_skripsi.max' => 'Ukuran file melebihi batas maksimum (1000 KB).',
        ]);

        if ($request->hasFile('file_revisi_skripsi')) {
            $skripsiFilePath = $request->file('file_revisi_skripsi');
            $fileName = $skripsiFilePath->getClientOriginalName();
            // $fileName = uniqid() . '.' . $skripsiFilePath->getClientOriginalExtension();
            $userFolder = Auth::user()->name;
            $skripsiFilePath->move(public_path('uploads/'.$userFolder.'/revisi_skripsi/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/revisi_skripsi/'.$fileName;
        } else {
            return response()->json(['success' => false, 'message' => 'File Skripsi tidak valid.']);
        }

        $revisi = new RevisiSidangSkripsi();
        $revisi->berita_acara_skripsi_id = $request->input('berita_acara_id'); // Sesuaikan ini dengan input yang benar
        $revisi->file_revisi = $fileUrl;
        $revisi->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'File berhasil diunggah.']);
    }
}
