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
        // dd($request->all());

        try {
            $fileProposalName = $request->file('ktm')->getClientOriginalName();
            $userFolder = $request->input('name');
            $request->file('ktm')->move(public_path("uploads/{$userFolder}/ktm/"), $fileProposalName);
            // Buat pengguna baru
            $user = User::create([
                'email' => $request->input('email'),
                'kode_unik' => $request->input('kode_unik'),
                'name' => $request->input('name'),
                'password' => bcrypt($request->input('password')),
                'ktm' => "uploads/{$userFolder}/ktm/{$fileProposalName}",
                'role_id' => 1,
                'status' => 'pending',
            ]);

            // Kirim notifikasi ke email pengguna
            // Implementasikan notifikasi email menggunakan Laravel Notifications

            // return view('auth/register')->with('script', 'showSuccessAlert();');
            // return redirect()->back()->with('script', 'showSuccessAlert();');

            return redirect()->back()->with('success', 'Pendaftaran berhasil. Tunggu persetujuan admin.');
        } catch (QueryException $e) {
            // Tangani kesalahan saat menyimpan ke database
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                // Duplicate entry for email or kode unik
                $column = strpos($e->getMessage(), 'kode_unik') !== false ? 'kode_unik' : 'email';

                return redirect()->back()->with('error', 'Gagal membuat pengguna. ' . ucfirst($column) . ' sudah digunakan.');
            } else {
                // Generic database error
                return redirect()->back()->with('error', 'Gagal membuat pengguna. Terjadi kesalahan internal. Silakan coba lagi nanti.');
            }
        }

    }

}
