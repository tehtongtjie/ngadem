<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use App\Models\Customer\Service;
use App\Models\Customer\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->paginate(10);
        return view('pages.customer.orders.index', compact('orders'));
    }

    /**
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $services = Service::where('status', 'aktif')->get();
        $selectedServiceId = $request->query('service_id');

        $metodePembayaranOptions = [
            'Cash',
            'Transfer Bank',
            'QRIS',
        ];
        return view('pages.customer.orders.create', compact('services', 'selectedServiceId', 'metodePembayaranOptions'));
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:today',
            'jam_service_diharapkan' => 'required|date_format:H:i',
            'alamat_service' => 'required|string|max:255',
            'deskripsi_masalah' => 'nullable|string',
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        $service = Service::find($request->service_id);
        $totalHarga = $service ? $service->harga_dasar : 0.00;

        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'tanggal_pesanan' => now(),
            'tanggal_service_diharapkan' => $request->tanggal_service_diharapkan,
            'jam_service_diharapkan' => $request->jam_service_diharapkan,
            'alamat_service' => $request->alamat_service,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'status_order' => 'pending',
            'total_harga' => $totalHarga,
        ]);

        Payment::create([
            'order_id' => $order->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $totalHarga,
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => now(),
        ]);

        return redirect()->route('customer.orders.index')->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Order  
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('pages.customer.orders.show', compact('order'));
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $services = Service::where('status', 'aktif')->get();

        return view('pages.customer.orders.edit', compact('order', 'services'));
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request 
     * @param  \App\Models\Customer\Order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:today',
            'jam_service_diharapkan' => 'required|date_format:H:i',
            'alamat_service' => 'required|string|max:255',
            'deskripsi_masalah' => 'nullable|string',
        ]);

        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses untuk memperbarui pesanan ini.');
        }

        $order->update([
            'service_id' => $request->service_id,
            'tanggal_service_diharapkan' => $request->tanggal_service_diharapkan,
            'jam_service_diharapkan' => $request->jam_service_diharapkan,
            'alamat_service' => $request->alamat_service,
            'deskripsi_masalah' => $request->deskripsi_masalah,
        ]);

        return redirect()->route('customer.orders.show', $order->id)->with('success', 'Pesanan Anda berhasil diperbarui!');
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses untuk menghapus pesanan ini.');
        }

        $order->delete();
        return redirect()->route('customer.orders.index')->with('success', 'Pesanan Anda berhasil dihapus!');
    }
}
