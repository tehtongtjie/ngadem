<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer\Order;
use App\Models\Customer\Service;
use App\Models\Customer\Payment;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->whereIn('status_order', ['diterima', 'dalam_proses'])
                        ->with(['user', 'service'])
                        ->orderBy('tanggal_service_diharapkan', 'asc')
                        ->paginate(10);

        return view('pages.teknisi.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->teknisi_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['user', 'service']);
        return view('pages.teknisi.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        if ($order->teknisi_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['user', 'service']);
        return view('pages.teknisi.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->teknisi_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status_order' => 'required|in:diterima,dalam_proses,selesai',
            'deskripsi_masalah' => 'nullable|string',
        ]);

        try {
            $order->status_order = $request->status_order;
            $order->deskripsi_masalah = $request->deskripsi_masalah;

            if ($order->isDirty('status_order') && $order->status_order === 'selesai') {
                Payment::firstOrCreate(
                    ['order_id' => $order->id],
                    [
                        'metode_pembayaran' => optional($order->payments->first())->metode_pembayaran ?? 'Cash',
                        'jumlah_bayar' => $order->total_harga,
                        'status_pembayaran' => 'pending',
                        'tanggal_pembayaran' => now(),
                    ]
                );
            }

            $order->save();

            return redirect()->route('teknisi.orders.show', $order->id)
                             ->with('success', 'Pesanan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating order: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui pesanan.')->withInput();
        }
    }

    public function destroy($id)
    {
        abort(403);
    }

    public function completed()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->where('status_order', 'selesai')
                        ->with(['user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.teknisi.orders.completed', compact('orders'));
    }

    public function assigned()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->whereIn('status_order', ['diterima', 'dalam_proses'])
                        ->with(['user', 'service'])
                        ->orderBy('tanggal_service_diharapkan', 'asc')
                        ->paginate(10);

        return view('pages.teknisi.orders.assigned', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->where('status_order', 'pending')
                        ->with(['user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.teknisi.orders.pending', compact('orders'));
    }

    public function declined()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->where('status_order', 'dibatalkan')
                        ->with(['user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.teknisi.orders.declined', compact('orders'));
    }

    public function history()
    {
        $orders = Order::where('teknisi_id', Auth::id())
                        ->whereIn('status_order', ['selesai', 'dibatalkan'])
                        ->with(['user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.teknisi.orders.history', compact('orders'));
    }

    public function uploadReport(Order $order)
    {
        if ($order->teknisi_id !== Auth::id() || $order->status_order !== 'selesai') {
            abort(403);
        }

        return view('pages.teknisi.orders.upload_report', compact('order'));
    }

    public function storeReport(Request $request, Order $order)
    {
        if ($order->teknisi_id !== Auth::id() || $order->status_order !== 'selesai') {
            abort(403);
        }

        $request->validate([
            'report_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        $reportPath = $order->report_path;

        if ($request->hasFile('report_file')) {
            if ($reportPath && Storage::disk('public')->exists($reportPath)) {
                Storage::disk('public')->delete($reportPath);
            }

            $reportPath = $request->file('report_file')->store('teknisi_reports', 'public');
        }

        $order->report_path = $reportPath;
        $order->save();

        return redirect()->route('teknisi.orders.show', $order->id)
                         ->with('success', 'Laporan berhasil diunggah!');
    }
}
