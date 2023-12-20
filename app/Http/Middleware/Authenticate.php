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

    // public function handle($request, Closure $next, ... $guards)
    // {
    //     $this->guards = $guards;
    //     $this->authenticate($request,$guards);

    //     return $next($request);
    // }

    protected function redirectTo($request)
    {
        // if ($request->expectsJson()) {
        //     return null;
        // }
        // foreach ($this->guards as $guard) {
        //     if (in_array($guard, ['mahasiswa', 'dosen', 'koordinator', 'ketuajurusan'])) {
        //         if (!auth()->guard($guard)->check()) {
        //             return redirect()->route('auth-login');  // Mengarahkan ke 'login' jika tidak terotentikasi
        //         } else {
        //             return redirect()->route('dashboard');  // Mengarahkan ke 'dashboard' jika terotentikasi
        //         }
        //     }
        // }
        // // Tidak ada peran yang sesuai, arahkan ke 'login'
        // return redirect()->route('auth-login');
        if (! $request->expectsJson()) {
            return redirect()->route('auth-login');
        }
    }
}
