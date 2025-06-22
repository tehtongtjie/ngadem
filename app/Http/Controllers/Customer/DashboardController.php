<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Order; 


class DashboardController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
public function index()
{
    $latestOrders = Order::where('user_id', Auth::id())
                          ->with(['service', 'teknisi']) 
                          ->orderBy('created_at', 'desc')
                          ->paginate(5);
    $userName = Auth::user()->name ?? 'Pengguna';

    return view('pages.customer.index', compact('latestOrders', 'userName'));
    }
}