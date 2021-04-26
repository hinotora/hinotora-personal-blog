<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends \App\Http\Controllers\Controller
{
    public function showLoginForm()
    {
        if(Auth::check()) {
            return redirect()->route('page-admin-dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $isRemember = (bool) $request->input('remember');

        if (Auth::attempt($credentials, $isRemember)) {
            $request->session()->regenerate();

            return redirect()->route('page-admin-dashboard')->setStatusCode(200);
        }

        return redirect()->route('page-admin-login')->setStatusCode(400);
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('page-admin-login')->setStatusCode(200);
    }
}
