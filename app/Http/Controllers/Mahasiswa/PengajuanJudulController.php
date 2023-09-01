<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Judul as Judul;

class PengajuanJudulController extends Controller
{
    //

    public function index()
    {
        $juduls = Judul::all();
        return view('koordinator/pengajuan_judul.index', compact('juduls'));

    }

    public function create()
    {
        // $juduls = Judul::all();
        return view('mahasiswa/proposal/pengajuan_judul.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'npm' => 'required|string',
            'bidang_ilmu' => 'required|string',
            'mk_pilihan' => 'required|array',
            'judul' => 'required|string',
        ], [
            'nama.required' => 'Nama is required.',
            'npm.required' => 'NPM is required.',
            'bidang_ilmu.required' => 'Bidang Ilmu is required.',
            'mk_pilihan.required' => 'At least one course must be selected.',
            'mk_pilihan.array' => 'Invalid courses selected.',
            'judul.required' => 'Judul is required.',
        ]);    

        $pengajuan = new Judul();
        $pengajuan->nama = $validatedData['nama'];
        $pengajuan->npm = $validatedData['npm'];
        $pengajuan->bidang_ilmu = $validatedData['bidang_ilmu'];
        $mk = implode(', ', $validatedData['mk_pilihan']);
        $pengajuan->mk_pilihan = $mk;
        $pengajuan->judul = $validatedData['judul'];
        // var_dump($pengajuan);
        $pengajuan->status='pending';
        $pengajuan->save();

        return redirect('/dashboard');
    }

    public function getdetail($id)
    {
        $data = DB::table('tema')->where('id', $id)->first();
        return response()->json($data);
    }

    public function updatestatus($id,Request $request)
    {
        // Validasi data jika diperlukan
       dd($request->all());
    $request->validate([
        'newStatus' => 'required|string', // Sesuaikan validasi dengan kebutuhan Anda
    ]);

    // Update status dalam tabel 'tema'
    DB::table('tema')
        ->where('id', $id) // Gunakan operator 'id' secara langsung
        ->update([
            'status' => $request->input('newStatus'),
            'updated_at' => now(), // Menggunakan fungsi now() untuk mengisi updated_at
        ]);

    return response()->json("berhasil");
    }
}
