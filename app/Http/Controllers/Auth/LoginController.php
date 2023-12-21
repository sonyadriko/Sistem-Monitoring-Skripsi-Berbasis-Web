<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = DB::table('users')
            ->where('email', $credentials['email'])
            ->pluck('email')
            ->first();
        $password = DB::table('users')
            ->where('email', $credentials['email'])
            ->pluck('password')
            ->first();
        $passwordCheck = Hash::check($request->password, $password);
        if ($credentials['email'] != $email) {
            return redirect()
                ->route('auth-login')
                ->with('danger', 'Your Email is wrong.');
        } else {
            return 'Role tidak diizinkan';
        }

        if ($role !== null) {
            // Pengguna memiliki peran yang sesuai dengan guards yang didefinisikan
            $login = \Auth::guard($role)->attempt($credentials);
        } else {
            return 'Role tidak diizinkan';
        }

        if ($login) {
            // Authentication successful
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                DB::table('histories')->insert([
                    'name_history' => 'Login', // Nama Aksi
                    'content_history' => 'Login berhasil', // Isi deskripsi dari aksi
                    'alert_history' => 'success', // kalau berhasil, maka success, kalau gagal maka warning atau danger (BS4)
                    'action_history' => 'user-add', // icon, tergantung dari pakainya apa
                    'status' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_by' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                ]);
            }
            if ($role === 'koordinator') {
                return redirect('/koordinator');
            } elseif ($role === 'dosen') {
                return redirect('/dosen');
            } elseif ($role == 'mahasiswa') {
                return redirect('/dashboard'); // Atau sesuaikan dengan halaman dashboard yang sesuai dengan peran
            } elseif ($role = 'ketuajurusan') {
                return redirect('/ketua_jurusan');
            }
        } else {
            // Authentication failed
            return redirect('/login')->with('error', 'Invalid email or password. Please try again.');
        }
    }

    public function logout(Request $request){
        $historyLogout = DB::table('histories')->insert([
            'name_history' => 'Logout', // Nama Aksi
            'content_history' => 'Logout berhasil', // Isi deskripsi dari aksi
            'alert_history' => 'success', // kalau berhasil, maka success, kalau gagal maka warning atau danger (BS4)
            'action_history' => 'user-remove', // icon, tergantung dari pakainya apa
            'status' => 1,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $request->session()->forget('key');
        $request->session()->flush();
        auth()->guard('mahasiswa')->logout();
        auth()->guard('dosen')->logout();
        auth()->guard('koordinator')->logout();
        auth()->guard('ketuajurusan')->logout();
        return redirect('/login');
    }
}
