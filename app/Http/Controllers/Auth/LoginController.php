<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    // public function login(Request $request)
    // {
    //     $remember = $request->has('remember')  ? true : false;
    //     $credentials = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     // $active = DB::table('users')
    //     //     ->where('email', $credentials['email'])
    //     //     ->pluck('status')
    //     //     ->first();
    //     $email = DB::table('users')
    //         ->where('email', $credentials['email'])
    //         ->pluck('email')
    //         ->first();
    //     $password = DB::table('users')
    //         ->where('email', $credentials['email'])
    //         ->pluck('password')
    //         ->first();
    //     $passwordCheck = Hash::check($request->password, $password);
    //     if ($credentials['email'] != $email) {
    //         return redirect()
    //             ->route('auth-login')
    //             ->with('danger', 'Your Email is wrong.');
    //     } else {
    //         if($passwordCheck){
    //             // If Remember
    //             if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)){
    //                 $request->session()->regenerate();
    //                 if(Auth::user()->role_id == '1'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 } else if(Auth::user()->role_id == '2'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }else if(Auth::user()->role_id == '3'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }else if(Auth::user()->role_id == '4'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }
    //                 // if user didn't click remember
    //             }elseif (Auth::attempt($credentials)){
    //                 $request->session()->regenerate();
    //                 if(Auth::user()->role_id == '1'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 } else if(Auth::user()->role_id == '2'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }else if(Auth::user()->role_id == '3'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }else if(Auth::user()->role_id == '4'){
    //                     return redirect()
    //                             ->route('dashboard')
    //                             ->with('success', 'Selamat Datang! '.Auth::user()->name);
    //                 }
    //             } else {
    //                 return redirect()
    //                 ->route('auth-login')
    //                 ->with('info', 'Akun anda tidak dipebolehkan masuk kedalam sistem.');
    //             }

    //         }else {
    //             return redirect()
    //             ->route('auth-login')
    //             ->with('danger', 'Maaf, mungkin Email atau Password Anda salah, mohon ulangi sekali lagi.');
    //         }
    //     }
    // }

    public function login(Request $request)
    {
        $user = MUser::where('email', $request->email)->first();

        if ($user === null) {
            return 'Email tidak ditemukan';
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
        } else {
            return 'Role tidak diizinkan';
        }

        if ($login) {
            // Authentication successful
            if ($role === 'koordinator') {
                return redirect('/koordinator');
            } elseif ($role === 'dosen') {
                return redirect('/dosen');
            } else {
                return redirect('/dashboard'); // Atau sesuaikan dengan halaman dashboard yang sesuai dengan peran
            }
        } else {
            // Authentication failed
            return redirect('/login')->with('error', 'Invalid email or password. Please try again.');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('key');
        $request->session()->flush();
        auth()->guard('mahasiswa')->logout();
           auth()->guard('dosen')->logout();
           auth()->guard('koordinator')->logout();
           auth()->guard('ketuajurusan')->logout();
            return redirect('/');
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