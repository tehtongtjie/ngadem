<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Payment;
use App\Models\Customer\Order;

class PendapatanController extends Controller
{
    /**
     *
     *
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $teknisiId = Auth::id();

        $successfulPayments = Payment::where('status_pembayaran', 'berhasil')
                                     ->whereHas('order', function ($query) use ($teknisiId) {
                                         $query->where('teknisi_id', $teknisiId);
                                     })
                                     ->get();

        $totalEarnings = $successfulPayments->sum(function ($payment) {
            return $payment->jumlah_bayar * 0.7; // 70% untuk teknisi
        });

        $totalOrdersCompleted = Order::where('teknisi_id', $teknisiId)
                                      ->where('status_order', 'selesai')
                                      ->count();

        $completedOrders = Order::where('teknisi_id', $teknisiId)
                                 ->where('status_order', 'selesai')
                                 ->with(['user', 'service'])
                                 ->orderBy('updated_at', 'desc')
                                 ->paginate(10);

        $pendapatanSummary = [
            'total_earnings' => $totalEarnings,
            'total_orders_completed' => $totalOrdersCompleted,
            'total_company_earnings' => $successfulPayments->sum(function ($payment) {
                return $payment->jumlah_bayar * 0.3;
            }),
        ];

        return view('pages.teknisi.pendapatan.index', compact('pendapatanSummary', 'completedOrders'));
    }
}
