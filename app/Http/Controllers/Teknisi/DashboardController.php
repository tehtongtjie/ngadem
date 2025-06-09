<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesananDiterima = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'diterima')
            ->count();
        $totalPesananSelesai = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'selesai')
            ->count();
        $totalPesananPending = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'pending')
            ->count();
        $latestPesanan = Order::where('teknisi_id', Auth::id())
            ->orderBy('tanggal_service_diharapkan', 'desc')
            ->limit(5)
            ->get();

        return view('pages.teknisi.index', compact(
            'totalPesananDiterima',
            'totalPesananSelesai',
            'totalPesananPending',
            'latestPesanan'
        ));
    }
}
