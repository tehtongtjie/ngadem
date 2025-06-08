<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Payment;
use App\Models\Customer\Order;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran untuk pelanggan yang terautentikasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = Payment::whereHas('order', function ($query) {
                                $query->where('user_id', Auth::id());
                            })
                            ->with('order')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('pages.customer.payments.index', compact('payments'));
    }

    /**
     * Menampilkan detail sumber daya pembayaran yang ditentukan.
     *
     * @param  \App\Models\Customer\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function show(Payment $payment)
    {
        $payment->load('order');

        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan melihat detail pembayaran ini.');
        }

        return view('pages.customer.payments.show', compact('payment'));
    }

    /**
     * Menampilkan formulir untuk mengunggah bukti pembayaran.
     * Pelanggan akan diarahkan ke sini dari halaman detail pembayaran atau pesanan.
     *
     * @param  \App\Models\Customer\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function uploadProof(Payment $payment)
    {
        // Pastikan pembayaran ini terkait dengan user yang login untuk keamanan
        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengunggah bukti pembayaran ini.');
        }

        // Hanya izinkan unggah jika status pembayaran masih 'pending' atau 'gagal'
        if ($payment->status_pembayaran === 'berhasil') {
            return redirect()->route('customer.payments.show', $payment->id)
                             ->with('error', 'Pembayaran ini sudah berhasil dikonfirmasi.');
        }

        return view('pages.customer.payments.upload-proof', compact('payment'));
    }

    /**
     * Menyimpan bukti pembayaran yang diunggah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProof(Request $request, Payment $payment)
    {
        // Pastikan pembayaran ini terkait dengan user yang login
        if ($payment->order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengunggah bukti pembayaran ini.');
        }

        // Validasi file yang diunggah
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maks 2MB
        ]);

        // Hapus bukti pembayaran lama jika ada
        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        // Simpan file baru ke direktori 'public/bukti_pembayaran'
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update path bukti pembayaran dan status pembayaran di database
        $payment->bukti_pembayaran = $path;
        $payment->status_pembayaran = 'pending'; // Kembali ke pending untuk menunggu konfirmasi admin
        $payment->save();

        return redirect()->route('pages.customer.payments.show', $payment->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }

    // Metode lain (create, store, edit, update, destroy) dibiarkan kosong atau sesuaikan kebutuhan
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
