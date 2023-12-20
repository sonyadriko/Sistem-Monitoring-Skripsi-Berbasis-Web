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
            if ($passwordCheck) {
                if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember) || Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    DB::table('histories')->insert([
                        'name_history' => 'Login',
                        'content_history' => 'Login berhasil',
                        'alert_history' => 'success',
                        'action_history' => 'user-check',
                        'status' => 1,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_by' => Auth::user()->id,
                        'updated_at' => Carbon::now(),
                    ]);
                    $getRoleID = Auth::user()->role_id;
                    if ($getRoleID == '1') {
                        return redirect()->route('home');
                    } else if ($getRoleID == '2') {
                        return redirect()->route('dashboard:dosen');
                    } else if ($getRoleID == '3') {
                        return redirect()->route('dashboard:koordinator');
                    } else if ($getRoleID == '4') {
                        return redirect()->route('dashboard:ketuajurusan');
                    } else {
                        return redirect()
                            ->route('auth-login')
                            ->with('danger', 'Maaf, mungkin Email atau Password Anda salah, mohon ulangi sekali lagi.');
                    }
                } else {
                    return redirect()
                        ->route('auth-login')
                        ->with('danger', 'Maaf, mungkin Email atau Password Anda salah, mohon ulangi sekali lagi.');
                }
            } else {
                return redirect()
                    ->route('auth-login')
                    ->with('danger', 'Your Password is wrong.');
            }
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
