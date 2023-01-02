<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('account', 'password');
        $remember_me = $request->only('remember_me');

        if (auth()->attempt($credentials, $remember_me)) {

            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'message' => '資料有誤，請重新輸入',
        ]);
    }

    public function postLogout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}