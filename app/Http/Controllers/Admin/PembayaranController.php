<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Customer\Payment;
use App\Models\Customer\Order;
use App\Models\User;
use App\Models\Customer\Service;

class PembayaranController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pembayarans = Payment::with(['order.user', 'order.service'])
                              ->orderBy('tanggal_pembayaran', 'desc')
                              ->paginate(10);

        return view('pages.admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = Order::doesntHave('payments')->get();
        return view('pages.admin.pembayaran.create', compact('orders'));
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id|unique:payments,order_id',
            'metode_pembayaran' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:pending,berhasil,gagal',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran_admin', 'public');
        }

        Payment::create([
            'order_id' => $request->order_id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar,
            'status_pembayaran' => $request->status_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Payment  $pembayaran
     * @return \Illuminate\View\View
     */
    public function show(Payment $pembayaran)
    {
        $pembayaran->load(['order.user', 'order.service']);
        return view('pages.admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Payment  $pembayaran
     * @return \Illuminate\View\View
     */
    public function edit(Payment $pembayaran)
    {
        $pembayaran->load('order');
        $orders = Order::all();
        return view('pages.admin.pembayaran.edit', compact('pembayaran', 'orders'));
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Models\Customer\Payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Payment $pembayaran)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,berhasil,gagal',
        ]);

        $pembayaran->status_pembayaran = $request->status_pembayaran;

        if ($request->hasFile('bukti_pembayaran_file')) {
            if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }
            $path = $request->file('bukti_pembayaran_file')->store('bukti_pembayaran_admin', 'public');
            $pembayaran->bukti_pembayaran = $path;
        }

        try {
            $pembayaran->save();

            $message = 'Status pembayaran berhasil diperbarui menjadi ' . ucfirst($pembayaran->status_pembayaran) . '.';
        } catch (\Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage(), ['payment_id' => $pembayaran->id, 'request_data' => $request->all()]);
            $message = 'Gagal memperbarui status pembayaran: ' . $e->getMessage();
            return redirect()->back()->with('error', $message)->withInput();
        }

        return redirect()->route('admin.pembayaran.show', $pembayaran->id)
                         ->with('success', $message);
    }

    /**
     *
     *
     * @param  \App\Models\Customer\Payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Payment $pembayaran)
    {
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
