<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthController
 * 
 * Menangani proses autentikasi pengguna (login/logout)
 * Login menggunakan kombinasi NIP dan Nama
 */
class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     * 
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses login request
     * 
     * Validasi NIP dan Nama, kemudian autentikasi user
     * User biasa login dengan NIP+Nama, Admin login dengan Email+Password
     * Jika user ditemukan, redirect ke halaman yang sesuai dengan role
     * Jika tidak, kembali ke halaman login dengan error message
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'nip'  => 'required|string',
            'name' => 'required|string',
        ]);

        // Cari user berdasarkan NIP dan Nama
        $user = User::where('nip', $credentials['nip'])
            ->where('name', $credentials['name'])
            ->first();

        // Jika user tidak ditemukan, kembalikan error
        if (!$user) {
            return back()->withErrors([
                'login' => 'NIP atau Nama tidak ditemukan.',
            ])->onlyInput('nip', 'name');
        }

        // Cek role dan validasi login method
        if ($user->role === 'admin') {
            // Admin tidak boleh login dengan NIP+Nama
            return back()->withErrors([
                'login' => 'Admin harus login melalui halaman admin dengan email dan password.',
            ])->onlyInput('nip', 'name');
        }

        // User biasa tidak boleh login jika role admin
        if ($user->role !== 'user') {
            return back()->withErrors([
                'login' => 'Akses ditolak. Role tidak valid.',
            ])->onlyInput('nip', 'name');
        }

        // Login user biasa
        Auth::login($user);

        // Redirect ke halaman form atau intended URL
        return redirect()->intended(route('perjadin.create'));
    }

    /**
     * Memproses logout request
     * 
     * Logout user, invalidate session, dan regenerate token
     * Kemudian redirect ke halaman home
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
