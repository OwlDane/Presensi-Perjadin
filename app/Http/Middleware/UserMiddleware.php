<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek jika user tidak login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek jika user adalah admin
        if (Auth::user()->role === 'admin') {
            // Logout admin dan redirect ke login
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')->withErrors([
                'login' => 'Admin tidak memiliki akses ke area user. Silakan login melalui halaman admin.',
            ]);
        }

        // Cek jika role tidak valid
        if (Auth::user()->role !== 'user') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')->withErrors([
                'login' => 'Role tidak valid. Akses ditolak.',
            ]);
        }

        return $next($request);
    }
}
