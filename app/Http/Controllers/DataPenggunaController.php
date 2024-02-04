<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DataPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKoordinator');
    }
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
        $datas = DB::table('users')
        ->leftjoin('pengajuan_judul', 'pengajuan_judul.users_id', 'users.id')
        ->leftjoin('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'pengajuan_judul.bidang_ilmu_id')
        ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.users_id', 'users.id')
        ->where('role_id', '1')->where('users.status', 'aktif')->get();
        $angkatan = DB::table('angkatan')->get();
        return view('koordinator/data_pengguna/mahasiswa.index', compact('datas', 'angkatan'));
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
        $datas = DB::table('users')->where('role_id', '1')->where('status', 'pending')->get();
        $angkatan = DB::table('angkatan')->get();

        return view('koordinator/data_pengguna/pengguna_baru.index', compact('datas', 'angkatan'));
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
            $user->delete();

            return redirect()->back()->with('success', 'Pengguna ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak pengguna');
        }
    }
}
