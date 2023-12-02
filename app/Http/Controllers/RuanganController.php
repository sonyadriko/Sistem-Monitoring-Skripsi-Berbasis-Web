<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ruangan as Ruangan;

class RuanganController extends Controller
{
    //
    public function index()
    {
            $ruangan = DB::table('ruangan')->get();

            return view('/koordinator/ruangan.index', compact('ruangan'));

    }
    public function create()
    {
        return view('koordinator/ruangan.create');
    }
    public function store(Request $request)
    {
        // Validasi input form jika diperlukan
        $request->validate([
            'namaRuangan' => 'required|string|max:255',
        ], [
            'namaRuangan.required' => 'Nama Ruangan is required.',
            'namaRuangan.string' => 'Nama Ruangan must be a string.',
            'namaRuangan.max' => 'Nama Ruangan may not be greater than 255 characters.',
            // Tambahkan pesan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan data ke database
        Ruangan::create([
            'nama_ruangan' => $request->input('namaRuangan'),
            // Sesuaikan dengan nama kolom pada tabel database
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // Temukan ruangan berdasarkan ID
        $ruangan = Ruangan::find($id);

        if ($ruangan) {
            // Hapus ruangan
            $ruangan->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
        } else {
            // Redirect dengan pesan error jika ruangan tidak ditemukan
            return redirect()->route('ruangan.index')->with('error', 'Ruangan tidak ditemukan.');
        }
    }
    public function edit($id)
    {
        // Temukan ruangan berdasarkan ID
        $ruangan = Ruangan::find($id);

        return view('/koordinator/ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form jika diperlukan
        $request->validate([
            'namaRuangan' => 'required|string|max:255',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Temukan ruangan berdasarkan ID
        $ruangan = Ruangan::find($id);

        if ($ruangan) {
            // Update data ruangan
            $ruangan->update([
                'nama_ruangan' => $request->input('namaRuangan'),
                // Sesuaikan dengan nama kolom pada tabel database
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
        } else {
            // Redirect dengan pesan error jika ruangan tidak ditemukan
            return redirect()->route('ruangan.index')->with('error', 'Ruangan tidak ditemukan.');
        }
    }

}
