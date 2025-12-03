<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required|string',
            'name' => 'required|string',
        ]);

        // Find user by NIP and name
        $user = User::where('nip', $credentials['nip'])
            ->where('name', $credentials['name'])
            ->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'NIP atau Nama tidak ditemukan.',
            ])->onlyInput('nip', 'name');
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('perjadian.create'));
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
