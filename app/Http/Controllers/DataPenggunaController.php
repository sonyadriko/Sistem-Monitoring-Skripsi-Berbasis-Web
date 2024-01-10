<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DataPenggunaController extends Controller
{
    public function index()
    {
        // $datas = DB::table('users')->where('role_id', '1')->get();
        $mahasiswaCount = DB::table('users')->where('role_id', '1')->where('status', 'aktif')->count();
        $dosenCount = DB::table('users')->where('role_id', '2')->count();
        $kajurCount = DB::table('users')->where('role_id', '4')->count();
        $newUserCount = DB::table('users')->where('role_id', '1')->where('status', 'pending')->count();
        return view('koordinator/data_pengguna.index', compact('mahasiswaCount', 'dosenCount', 'kajurCount', 'newUserCount'));
    }
    public function mhs()
    {
        // $datas = DB::table('users')->where('role_id', '1')->get();
        $datas = DB::table('users')->where('role_id', '1')->where('status', 'aktif')->get();
        return view('koordinator/data_pengguna/mahasiswa.index', compact('datas'));
    }
    public function dosen()
    {
        $datas = DB::table('users')->where('role_id', '2')->get();
        return view('koordinator/data_pengguna/dosen.index', compact('datas'));
    }
    public function kajur()
    {
        $datas = DB::table('users')->where('role_id', '4')->get();
        return view('koordinator/data_pengguna/kajur.index', compact('datas'));
    }
    public function newuser()
    {
        // $datas = DB::table('users')->where('role_id', '1')->get();
        $datas = DB::table('users')->where('role_id', '1')->where('status', 'pending')->get();
        return view('koordinator/data_pengguna/pengguna_baru.index', compact('datas'));
    }
    public function terima($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = 'aktif'; // Gantilah 'aktif' sesuai dengan nilai yang sesuai di model Anda
            $user->save();

            return redirect()->back()->with('success', 'Pengguna diterima');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima pengguna');
        }
    }

    public function tolak($id)
    {
        try {
            $user = User::findOrFail($id);
            // $user->status = 'nonaktif'; // Gantilah 'nonaktif' sesuai dengan nilai yang sesuai di model Anda
            $user->delete();

            return redirect()->back()->with('success', 'Pengguna ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak pengguna');
        }
    }
}
