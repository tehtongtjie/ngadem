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
     * Display the technician earnings dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated technician's ID
        $teknisiId = Auth::id();

        // Retrieve successful payments for the technician's orders
        $successfulPayments = Payment::where('status_pembayaran', 'berhasil')
            ->whereHas('order', function ($query) use ($teknisiId) {
                $query->where('teknisi_id', $teknisiId)
                      ->where('status_order', 'selesai'); // Ensure only completed orders
            })
            ->with(['order' => function ($query) use ($teknisiId) {
                $query->where('teknisi_id', $teknisiId);
            }])
            ->get();

        // Calculate total earnings (70% of payment amount)
        $totalEarnings = $successfulPayments->sum(function ($payment) {
            return (float) ($payment->jumlah_bayar ?? 0) * 0.7; // Ensure float and handle null
        });

        $totalOrdersCompleted = Order::where('teknisi_id', $teknisiId)
            ->where('status_order', 'selesai')
            ->count();

        $completedOrders = Order::where('teknisi_id', $teknisiId)
            ->where('status_order', 'selesai')
            ->with(['user', 'service'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $completedOrders->getCollection()->transform(function ($order) use ($successfulPayments) {
            $payment = $successfulPayments->firstWhere('order_id', $order->id);
            $order->earnings = $payment ? (float) ($payment->jumlah_bayar * 0.7) : 0;
            return $order;
        });

        $pendapatanSummary = [
            'total_earnings' => $totalEarnings,
            'total_orders_completed' => $totalOrdersCompleted,
        ];

        if ($totalEarnings == 0) {
            \Log::info('Technician Earnings Debug', [
                'teknisi_id' => $teknisiId,
                'successful_payments_count' => $successfulPayments->count(),
                'completed_orders_count' => $totalOrdersCompleted,
            ]);
        }

        return view('pages.teknisi.pendapatan.index', compact('pendapatanSummary', 'completedOrders'));
    }
}
