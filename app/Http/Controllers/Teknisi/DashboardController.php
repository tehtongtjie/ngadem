<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.teknisi.index');
    }
}
