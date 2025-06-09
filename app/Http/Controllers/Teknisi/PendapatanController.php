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
     * Menampilkan dashboard atau data pendapatan (earnings) untuk teknisi yang sedang login.
     * Mengambil data dari tabel payments dan orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $teknisiId = Auth::id(); // ID teknisi yang sedang login
        
        // Menyaring pembayaran berhasil yang terkait dengan teknisi ini
        $successfulPayments = Payment::where('status_pembayaran', 'berhasil')
                                     ->whereHas('order', function ($query) use ($teknisiId) {
                                         $query->where('teknisi_id', $teknisiId);
                                     })
                                     ->get();

        // Hitung total pendapatan teknisi (misalnya 70% dari jumlah pembayaran)
        $totalEarnings = $successfulPayments->sum(function ($payment) {
            return $payment->jumlah_bayar * 0.7; // 70% untuk teknisi
        });

        // Hitung total pesanan yang sudah selesai
        $totalOrdersCompleted = Order::where('teknisi_id', $teknisiId)
                                      ->where('status_order', 'selesai')
                                      ->count();

        // Dapatkan daftar pesanan yang telah selesai untuk teknisi ini
        $completedOrders = Order::where('teknisi_id', $teknisiId)
                                 ->where('status_order', 'selesai')
                                 ->with(['user', 'service'])
                                 ->orderBy('updated_at', 'desc')
                                 ->paginate(10);

        // Ringkasan data untuk dashboard pendapatan teknisi
        $pendapatanSummary = [
            'total_earnings' => $totalEarnings,
            'total_orders_completed' => $totalOrdersCompleted,
            'total_company_earnings' => $successfulPayments->sum(function ($payment) {
                return $payment->jumlah_bayar * 0.3; // 30% untuk perusahaan
            }),
        ];

        // Mengembalikan data untuk ditampilkan di view
        return view('pages.teknisi.pendapatan.index', compact('pendapatanSummary', 'completedOrders'));
    }
}
