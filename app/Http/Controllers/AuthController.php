<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email not found'
            ]);
        }

         if (!$user->status) { // jika kolom status bernilai false/0
        return back()->withErrors([
            'email' => 'Akun Anda tidak aktif. Silakan hubungi admin.'
        ]);
    }

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return back()->withErrors([
                'password' => 'Incorrect password'
            ]);
        }


        return redirect()->route('dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('beranda')->with('success', 'Logout succesfully');
    }
}
