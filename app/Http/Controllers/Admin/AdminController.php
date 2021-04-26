<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends \App\Http\Controllers\Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
