<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckRole::class . ':organizer');
    }

    public function dashboard()
    {
        return view('organizer.dashboard');
    }
}
