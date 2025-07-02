<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = User::where('role', 'customer')->count();
        $totalTeknisi = User::where('role', 'teknisi')->count();
        $totalLayanan = Service::count();

        $latestLayanan = Service::orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.admin.index', compact('totalPelanggan', 'totalTeknisi', 'totalLayanan', 'latestLayanan'));
    }
}
