<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post('https://api-test.eksam.cloud/api/v1/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            session(['token' => $response['data']['access_token']]);
            return redirect('/home')->with('success', 'Berhasil login!');
        } else {
            return back()->with('error', 'Email atau password salah.');
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Http::post('https://api-test.eksam.cloud/api/v1/auth/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->successful()) {
            return redirect('/')->with('success', 'Pendaftaran berhasil. Mohon untuk login.');
        } else {
            return back()->with('error', 'Pendaftaran gagal.');
        }
    }

    public function logout()
    {
        Http::withToken(session('token'))->post('https://api-test.eksam.cloud/api/v1/auth/logout');
        session()->flush();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
