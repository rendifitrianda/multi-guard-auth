<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    //This Method will show login page for costumer
    public function showloginpage()
    {
        return view('login');
    }

    //This Will method Authentication User
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email Not Required',
            'email.email' => 'Invalid Email Format',
            'password.required' => 'Password Not Required',
        ]);
  
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
      //PESAN JIKA LOGIN GAGAL
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function register ()
    {
        return view('register');
    }

    public function proccesRegister(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ],[
            'name.required' => 'Masukkan nama',
            'email.required' => 'Masukkan email',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Masukkan password',
            'password.confirmed' => 'Password tidak sama',
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'role' => 'costumer'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('account/login')->with('success', 'Register Berhasil');
        }else{
            return redirect()->route('register')->with('error', 'Register Gagal');
        }
    }
}
