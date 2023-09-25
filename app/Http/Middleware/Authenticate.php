<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }


    public function handle($request, Closure $next, ... $guards)
    {
        $this->guards = $guards;
        $this->authenticate($request,$guards);

        return $next($request);
    }


    protected function redirectTo($request)
    {
        if (in_array('mahasiswa', $this->guards)) {
            // Cek apakah 'mahasiswa' ada dalam daftar guards
            if (!auth()->guard('mahasiswa')->check()) {
                return route('home'); // Mengarahkan ke 'auth-login' jika tidak terotentikasi
            } else {
                return route('dashboard'); // Mengarahkan ke 'dashboard' jika terotentikasi
            }
        } else if (in_array('dosen', $this->guards)) {
            // Cek apakah 'dosen' ada dalam daftar guards
            if (!auth()->guard('dosen')->check()) {
                return route('home'); // Mengarahkan ke 'auth-login' jika tidak terotentikasi
            } else {
                return route('dashboard'); // Mengarahkan ke 'dashboard' jika terotentikasi
            }
        } else if (in_array('koordinator', $this->guards)) {
            // Cek apakah 'koordinator' ada dalam daftar guards
            if (!auth()->guard('koordinator')->check()) {
                return route('home'); // Mengarahkan ke 'auth-login' jika tidak terotentikasi

            } else {
                return route('dashboard'); // Mengarahkan ke 'dashboard' jika terotentikasi
            }
        } else if (in_array('ketuajurusan', $this->guards)) {
            // Cek apakah 'ketuajurusan' ada dalam daftar guards
            if (!auth()->guard('ketuajurusan')->check()) {
                return route('home'); // Mengarahkan ke 'auth-login' jika tidak terotentikasi
            } else {
                return route('dashboard'); // Mengarahkan ke 'dashboard' jika terotentikasi
            }
        } else {
            // Tidak ada peran yang sesuai, arahkan ke 'auth-login'
            return route('auth-login');
        }
        
    }

    
}
