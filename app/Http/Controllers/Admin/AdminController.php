<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * Returns dashboard in the admin section.
     *
     * @return View
     */
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }
}
