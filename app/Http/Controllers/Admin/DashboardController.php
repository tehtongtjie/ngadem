<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Order; // Ensure this points to your Customer\Order model

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard customer.
     * Metode ini mengambil 3 pesanan terbaru untuk user yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $latestOrders = Order::where('user_id', Auth::id())
                              ->with(['service', 'teknisi']) // Eager load relations for performance
                              ->orderBy('created_at', 'desc')
                              ->limit(3) // Get only the 3 latest orders
                              ->get(); // Fetch the data

        $userName = Auth::user()->name ?? 'Pengguna'; // Get user name, with a fallback
        
        return view('pages.admin.index', compact('latestOrders', 'userName'));
    }
}