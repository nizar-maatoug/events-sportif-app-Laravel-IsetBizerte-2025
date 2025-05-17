<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckRole::class . ':admin');

    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
