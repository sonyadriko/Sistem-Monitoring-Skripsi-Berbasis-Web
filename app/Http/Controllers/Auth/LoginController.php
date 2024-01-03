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
use App\Models\User as MUser;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $user = MUser::where('email', $request->email)->first();

        if ($user === null) {
            // return 'Email tidak ditemukan';
            return redirect('/login')->withErrors(['error' => 'Email tidak ditemukan.']);

        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $role = null;

        if ($user->role_id == 1) {
            $role = 'mahasiswa';
        } elseif ($user->role_id == 2) {
            $role = 'dosen';
        } elseif ($user->role_id == 3) {
            $role = 'koordinator';
        } elseif ($user->role_id == 4) {
            $role = 'ketuajurusan';
        } else {
            return 'Role tidak diizinkan';
        }

        if ($role !== null) {
            // Pengguna memiliki peran yang sesuai dengan guards yang didefinisikan
            $login = \Auth::guard($role)->attempt($credentials);

            if ($login) {
                // Authentication successful
                if ($user->status == 'aktif') {
                    // Cek status aktif
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
                    // DB::table('histories')->insert([
                    //     'name_history' => 'Login',
                    //     'content_history' => 'Login berhasil',
                    //     'alert_history' => 'success',
                    //     'action_history' => 'user-add',
                    //     'status' => 1,
                    //     'created_by' => Auth::user()->id,
                    //     'created_at' => Carbon::now(),
                    //     'updated_by' => Auth::user()->id,
                    //     'updated_at' => Carbon::now(),
                    // ]);

                    if ($role === 'koordinator') {
                        return redirect('/koordinator')->with('success', 'Login berhasil. Selamat datang koordinator!');
                    } elseif ($role === 'dosen') {
                        return redirect('/dosen')->with('success', 'Login berhasil. Selamat datang dosen!');
                    } elseif ($role === 'mahasiswa') {
                        return redirect('/dashboard')->with('success', 'Login berhasil. Selamat datang Mahasiswa!');
                    } elseif ($role === 'ketuajurusan') {
                        return redirect('/ketua_jurusan')->with('success', 'Login berhasil. Selamat datang Ketua Jurusan!');
                    }
                } else {
                    // Jika status tidak aktif, tambahkan handling di sini
                    // return redirect('/login')->with('error', 'Akun tidak aktif.');
                    return redirect('/login')->withErrors(['error' => 'Akun tidak aktif.']);

                }
            } else {
                // Authentication failed
                // return redirect('/login')->with('error', 'Invalid email or password. Please try again.');
                return redirect('/login')->withErrors(['error' => 'email atau kata sandi salah. Silakan coba lagi.']);
            }
        } else {
            // Role tidak diizinkan
            return redirect('/login')->withErrors(['error' => 'Role tidak diizinkan.']);

            // return 'Role tidak diizinkan';
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




    // public function logout(Request $request)
    // {
    //     if (! Auth::user()) {
    //         return redirect()
    //             ->route('auth-login')
    //             ->with('success', 'Terima kasih telah menggunakan aplikasi ini!');
    //     } else {
    //         if ($request->ajax()) {
    //             Auth::Logout();

    //             return redirect()
    //                 ->route('auth-login')
    //                 ->with('success', 'Mohon Login dengan password baru Anda.');
    //         } else {
    //             Auth::Logout();

    //             return redirect()
    //                 ->route('auth-login')
    //                 ->with('success', 'Terima kasih telah menggunakan aplikasi ini!');
    //         }
    //     }
    // }

}
