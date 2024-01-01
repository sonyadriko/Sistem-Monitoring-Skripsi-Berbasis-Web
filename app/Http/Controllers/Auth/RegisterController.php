<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm()
    {
        return view('auth/register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'npm' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\User
    //  */
    // protected function create(array $data)
    // {
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'kode_unik' => $data['npm'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role_id' => 1,
    //         'status' => 'pending',
    //     ]);

    //     // Redirect ke halaman tunggu konfirmasi setelah registrasi
    //     return redirect()->route('waiting_confirmation')->with('success', 'Pendaftaran berhasil. Tunggu konfirmasi dari admin.');
    // }

    // protected function registerus(array $data)
    // {
    //     $validator = Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'npm' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('register')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $user = User::create([
    //         'name' => $data['name'],
    //         'kode_unik' => $data['npm'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role_id' => 1,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('waiting_confirmation')->with('success', 'Pendaftaran berhasil. Tunggu konfirmasi dari admin.');
    // }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'kode_unik' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

          // Debug: Dump data setelah validasi
        dd($request->all());

        try {
            // Buat pengguna baru
            $user = User::create([
                'email' => $request->input('email'),
                'kode_unik' => $request->input('kode_unik'),
                'name' => $request->input('name'),
                'password' => bcrypt($request->input('password')),
                'role_id' => 1,
                'status' => 'pending',
            ]);

            // Kirim notifikasi ke email pengguna
            // Implementasikan notifikasi email menggunakan Laravel Notifications

            return redirect()->back()->with('success', 'Pendaftaran berhasil. Tunggu persetujuan admin.');
        } catch (QueryException $e) {
            // Tangani kesalahan saat menyimpan ke database
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                return redirect()->back()->with('error', 'Gagal membuat pengguna. Email atau kode unik sudah digunakan.');
            } else {
                return redirect()->back()->with('error', 'Gagal membuat pengguna. Terjadi kesalahan internal.');
            }
        }
    }

}
