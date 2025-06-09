<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer\Order;    
use App\Models\Customer\Payment; 
use App\Models\Customer\Service;
use App\Models\User;
class PesananController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pesanan = Order::with(['teknisi', 'user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.admin.pesanan.index', compact('pesanan'));
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Order  
     * @return \Illuminate\View\View
     */
    public function show(Order $pesanan)
    {
        $pesanan->load(['teknisi', 'user', 'service']);
        return view('pages.admin.pesanan.show', compact('pesanan'));
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Order 
     * @return \Illuminate\View\View
     */
    public function edit(Order $pesanan)
    {
        $pesanan->load(['teknisi', 'user', 'service']);
        $teknisis = User::where('role', 'teknisi')->get();
        $customers = User::where('role', 'customer')->get();
        $services = Service::where('status', 'aktif')->get();

        return view('pages.admin.pesanan.edit', compact('pesanan', 'teknisis', 'customers', 'services'));
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Models\Customer\Order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $pesanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'teknisi_id' => 'nullable|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'tanggal_pesanan' => 'required|date',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:tanggal_pesanan',
            'jam_service_diharapkan' => 'required|date_format:H:i:s',
            'alamat_service' => 'required|string|max:255', 
            'deskripsi_masalah' => 'nullable|string',
            'status_order' => 'required|in:pending,diterima,dalam_proses,selesai,dibatalkan',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $pesanan->update($request->all());

        if ($pesanan->status_order === 'selesai' || $pesanan->status_order === 'dalam_proses') {
            $payment = Payment::where('order_id', $pesanan->id)->first();

            if (!$payment) {
                Payment::create([
                    'order_id' => $pesanan->id,
                    'metode_pembayaran' => $request->input('metode_pembayaran', 'Cash'), 
                    'status_pembayaran' => $request->input('status_pembayaran', 'pending'),
                    'tanggal_pembayaran' => now(),
                ]);
                $message = 'Status pesanan berhasil diperbarui & tagihan pembayaran berhasil dibuat.';
            } else {
                $message = 'Status pesanan berhasil diperbarui.';
            }
        } else {
            $message = 'Pesanan berhasil diperbarui.';
        }

        return redirect()->route('admin.pesanan.show', $pesanan->id)
                         ->with('success', $message);
    }
}