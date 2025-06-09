<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total pesanan diterima
        $totalPesananDiterima = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'diterima')
            ->count();

        // Mengambil total pesanan selesai
        $totalPesananSelesai = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'selesai')
            ->count();

        // Mengambil total pesanan pending
        $totalPesananPending = Order::where('teknisi_id', Auth::id())
            ->where('status_order', 'pending')
            ->count();

        // Mengambil pesanan terbaru
        $latestPesanan = Order::where('teknisi_id', Auth::id())
            ->orderBy('tanggal_service_diharapkan', 'desc')
            ->limit(5) // Ambil 5 pesanan terbaru
            ->get();

        // Menyertakan data ke view
        return view('pages.teknisi.index', compact(
            'totalPesananDiterima',
            'totalPesananSelesai',
            'totalPesananPending',
            'latestPesanan'
        ));
    }
}
