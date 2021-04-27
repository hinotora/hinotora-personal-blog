<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Returns login form view of redirects to admin
     * dashboard if already logged in.
     *
     * @return View|RedirectResponse
     */
    public function showLoginForm(): View
    {
        if(Auth::check()) {
            return redirect()->route('page-admin-dashboard');
        }

        return view('admin.login');
    }

    /**
     * Check user and auth with redirect.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $isRemember = (bool) $request->input('remember');

        if (Auth::attempt($credentials, $isRemember)) {
            $request->session()->regenerate();

            return redirect()->route('page-admin-dashboard')->setStatusCode(200);
        }

        return redirect()->route('page-admin-login')->setStatusCode(400);
    }

    /**
     * Logout and redirect back to login form
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('page-admin-login')->setStatusCode(200);
    }
}
