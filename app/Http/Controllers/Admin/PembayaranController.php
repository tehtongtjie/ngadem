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
     * Menampilkan daftar semua pembayaran.
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
     * Menampilkan formulir untuk membuat pembayaran baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = Order::doesntHave('payments')->get();
        return view('pages.admin.pembayaran.create', compact('orders'));
    }

    /**
     * Menyimpan pembayaran baru ke database.
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
     * Menampilkan detail pembayaran tertentu.
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
     * Menampilkan formulir untuk mengedit pembayaran.
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
     * Memperbarui status pembayaran di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Payment  $pembayaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Payment $pembayaran)
    {
        // Validasi untuk memastikan status pembayaran yang dikirim valid
        $request->validate([
            'status_pembayaran' => 'required|in:pending,berhasil,gagal',
        ]);

        // Jika hanya ingin mengubah status pembayaran
        $pembayaran->status_pembayaran = $request->status_pembayaran;

        // Cek jika ada file bukti pembayaran yang baru
        if ($request->hasFile('bukti_pembayaran_file')) {
            // Hapus bukti pembayaran yang lama jika ada
            if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }

            // Simpan bukti pembayaran yang baru
            $path = $request->file('bukti_pembayaran_file')->store('bukti_pembayaran_admin', 'public');
            $pembayaran->bukti_pembayaran = $path;
        }

        // Simpan perubahan ke database
        try {
            $pembayaran->save(); // Simpan perubahan status pembayaran

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
     * Menghapus pembayaran dari penyimpanan.
     *
     * @param  \App\Models\Customer\Payment  $pembayaran
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
