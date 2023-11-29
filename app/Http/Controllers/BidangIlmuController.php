<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\BidangIlmu as BidangIlmu;
use App\Models\PaperBidangIlmu as PaperBidangIlmu;


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
        // Validation rules
        $validatedData = $request->validate([
            'topik_bidang_ilmu' => 'required|string',
            'matkulpen.*' => 'required|string', // You can remove this line if it's not part of the form
            'sub_bidang_ilmu' => 'required|string',
            'keterangan' => 'required|string',
            'paper.*' => 'required|mimes:pdf,docx|max:2048',
        ], [
            'topik_bidang_ilmu.required' => 'Topik bidang ilmu is required.',
            'sub_bidang_ilmu.required' => 'Sub bidang ilmu is required.',
            'keterangan.required' => 'Keterangan is required.',
            'paper.*.required' => 'Each file is required.',
            'paper.*.mimes' => 'Each file must be a PDF or DOCX.',
            'paper.*.max' => 'Each file must not exceed 2MB in size.',
        ]);
        $matkulpen = $request->input('matkulpen') ?? [];

        // Create a new BidangIlmu instance
        $form = new BidangIlmu();

        // Set user_id to the current user's ID
        $form->user_id = Auth::user()->id;

        // Set other form data
        $form->topik_bidang_ilmu = $validatedData['topik_bidang_ilmu'];
        $form->sub_bidang_ilmu = $validatedData['sub_bidang_ilmu'];
        $form->status = 'tersedia';
        $form->keterangan = $validatedData['keterangan'];

        // Handle mata_kuliah_pendukung checkbox
        $form->mata_kuliah_pendukung = implode(',', $matkulpen) ?? null;


        // Save the BidangIlmu instance
        $form->save();

        // Handle file uploads and associate with BidangIlmu
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
                $paper->bidang_ilmu_id = $form->id_bidang_ilmu; // Assuming id is the primary key of the bidang_ilmu table
                $paper->file = $fileUrl;

                // Save the PaperBidangIlmu instance
                $paper->save();
            }
        }

        // Flash success message to the session
        Session::flash('success', 'Tema Penelitian berhasil ditambahkan');

        // Redirect to the dashboard or any other appropriate route
        return redirect('/dosen/bidang_ilmu');
    }

    public function detail($id, Request $request)
    {
        $bidetail = DB::table('bidang_ilmu')
                    // ->join('paper_bidang_ilmu', 'paper_bidang_ilmu.bidang_ilmu_id', 'bidang_ilmu.id_bidang_ilmu')
                    ->where('id_bidang_ilmu', $id)->first();
        $paper = DB::table('paper_bidang_ilmu')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'paper_bidang_ilmu.bidang_ilmu_id')
                    ->where('id_bidang_ilmu', $id)->get();
        return view('dosen/bidang_ilmu.detail', compact('bidetail', 'paper'));
    }
}
