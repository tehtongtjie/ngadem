<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Customer\Order;
use App\Models\Customer\Service;

class DashboardController extends Controller
{
    /**
     *
     *
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalPelanggan = User::where('role', 'customer')->count();
        $totalTeknisi = User::where('role', 'teknisi')->count();
        $totalLayanan = Service::count(); 
        
        $latestLayanan = Service::orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.admin.index', compact('totalPelanggan', 'totalTeknisi', 'totalLayanan', 'latestLayanan'));
    }
}