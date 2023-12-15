<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\PaperBidangIlmu as PaperBidangIlmu;
use Illuminate\Http\Request;

class DosenBidangIlmuController extends Controller
{
    //
    public function index()
    {
        $bi = DB::table('detail_bidang_ilmu')
        ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'detail_bidang_ilmu.bidang_ilmu_id')
        ->join('users', 'users.id', 'detail_bidang_ilmu.users_id')
        ->where('detail_bidang_ilmu.users_id', Auth::user()->id)
        ->get();
        return view('dosen/bidang_ilmu.index', compact('bi'));
    }
    public function detail($id, Request $request)
    {
        $bidetail = DB::table('bidang_ilmu')
                    ->join('mata_kuliah_pendukung', 'mata_kuliah_pendukung.id_mata_kuliah_pendukung', 'bidang_ilmu.mata_kuliah_pendukung')
                    ->where('id_bidang_ilmu', $id)->first();
        $paper = DB::table('paper_bidang_ilmu')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'paper_bidang_ilmu.bidang_ilmu_id')
                    ->where('id_bidang_ilmu', $id)->get();
        return view('dosen/bidang_ilmu.detail', compact('bidetail', 'paper'));
    }
    public function submitpaper($id, Request $request)
    {
        $validatedData = $request->validate([
            'paper.*' => 'required|mimes:pdf,docx|max:10000',
        ], [
            'paper.*.required' => 'Each file is required.',
            'paper.*.mimes' => 'Each file must be a PDF.',
            'paper.*.max' => 'Each file must not exceed 10MB in size.',
            ]);
        if ($request->hasFile('paper')) {
            foreach ($request->file('paper') as $file) {
                // Store each file in the 'papers' directory with a safe name
                $safeFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $safeFileName . '_' . time() . '.' . $file->getClientOriginalExtension();
                $userFolder = Auth::user()->name;
                // $filePath = $file->storeAs('papers', $fileName, 'public');
                $file->move(public_path('uploads/'.$userFolder.'/paper/'), $fileName);
                $fileUrl = 'uploads/'.$userFolder.'/paper/'.$fileName;

                // Create a new PaperBidangIlmu model instance
                $paper = new PaperBidangIlmu();

                // Set the bidang_ilmu_id and file_path in the model
                $paper->bidang_ilmu_id = $id; // Assuming id is the primary key of the bidang_ilmu table
                $paper->file = $fileUrl;

                // Save the PaperBidangIlmu instance
                $paper->save();
            }
        }
        return redirect()->back()->with('success', 'Paper Berhasil Diupload.');

            // Flash success message to the session
            // Session::flash('success', 'Tema Penelitian berhasil ditambahkan');
    }
}
